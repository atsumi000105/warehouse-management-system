<?php

namespace App\Transformers;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\AttributeDefinition;
use App\Entity\EAV\AttributeValue;
use App\Entity\EAV\Type\AddressAttributeValue;
use App\Entity\EAV\Type\ZipCountyAttributeValue;
use App\Entity\User;
use League\Fractal\TransformerAbstract;

class AttributeTransformer extends TransformerAbstract
{
    public $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    protected $availableIncludes = [
        'options',
    ];

    protected $defaultIncludes = [
        'value',
        'attributeFieldPermissions',
    ];

    public function transform(Attribute $attribute): array
    {
        return [
            'id' => (int) $attribute->getId(),
            'definition_id' => (int) $attribute->getDefinition()->getId(),
            'name' => $attribute->getDefinition()->getName(),
            'label' => $attribute->getDefinition()->getLabel(),
            'labelEs' => $attribute->getDefinition()->getLabelEs(),
            'type' => $attribute->getDefinition()->getType(),
            'helpText' => $attribute->getDefinition()->getHelpText(),
            'helpTextEs' => $attribute->getDefinition()->getHelpTextEs(),
            'displayInterface' => $attribute->getDefinition()->getDisplayInterface(),
            'orderIndex' => $attribute->getDefinition()->getOrderIndex(),
            'hasOptions' => $attribute->hasOptions(),
            'isDisplayedPublicly' => $attribute->getDefinition()->getIsDisplayedPublicly(),
            'isRequired' => $attribute->getDefinition()->getRequired(),
            'user' => ($this->user instanceof User) ? $this->user->getCurrentUserGroupIds() : [],
        ];
    }

    public function includeValue(Attribute $attribute)
    {
        $transformer = null;

        if ($attribute->isEmpty() && $attribute->isMultivalued()) {
            return $this->primitive([]);
        }

        if ($attribute->isEmpty() && !$attribute->isMultivalued()) {
            return $attribute->hasRelationshipValue() ? $this->primitive(['id' => null]) : $this->primitive(null);
        }

        if ($attribute->getDefinition()->getType() == AttributeDefinition::TYPE_FILE) {
            $transformer = new FileTransformer();
        }

        if ($attribute->getDefinition()->getType() == AttributeDefinition::TYPE_ADDRESS) {
            $transformer = new AddressTransformer();
        }

        if ($attribute->getDefinition()->getType() == AttributeDefinition::TYPE_ZIPCODE) {

            /**
             * @TODO! Need to consider the case where the ZipCountyField have multiple values. This is not currently considered in the ZipCountyTransformer
             */
            $transformer = new ZipCountyTransformer();

            /*$jsonValues = $attribute->getJsonValues();
            return $attribute->isMultivalued() ?
                $this->primitive($jsonValues) :
                $this->primitive(reset($jsonValues));*/
        }

        if ($transformer === null) {
            $jsonValues = $attribute->getJsonValues();

            return $attribute->isMultivalued() ?
                $this->primitive($jsonValues) :
                $this->primitive(reset($jsonValues));
        }

        return $attribute->isMultivalued() ?
            $this->collection($attribute->getValues(), $transformer) :
            $this->item($attribute->getValues()->first(), $transformer);
    }

    public function includeAttributeFieldPermissions(Attribute $attribute)
    {
        $attributeFieldPermissions = $attribute->getDefinition()->getPermissions();

        return $this->collection($attributeFieldPermissions, new AttributeDefinitionPermissionTransformer);
    }

    public function includeOptions(Attribute $attribute)
    {
        $options = $attribute->getDefinition()->getOptions();

        return $this->collection($options, new AttributeDefinitionOptionTransformer());
    }
}
