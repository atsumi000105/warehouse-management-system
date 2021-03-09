<?php

namespace App\Listener;

use App\Entity\Client;
use App\Entity\EAV\ClientDefinition;
use App\IdGenerator\RandomIdGenerator;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ClientListener implements EventSubscriber
{
    /**
     * @var RandomIdGenerator
     */
    protected $gen;

    /**
     * @var MailerInterface
     */
    protected $mailer;

    public function __construct(RandomIdGenerator $gen, MailerInterface $mailer)
    {
        $this->gen = $gen;
        $this->mailer = $mailer;
    }

    public function postLoad(LifecycleEventArgs $event)
    {
        $client = $event->getEntity();
        if (!$client instanceof Client) {
            return;
        }

        $em = $event->getEntityManager();
        $definitions = $em->getRepository(ClientDefinition::class)->findAll();

        $emptyAttributes = array_map(function (ClientDefinition $defintion) {
            return $defintion->createAttribute();
        }, $definitions);

        $client->addAttributes($emptyAttributes, false);
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $client = $event->getEntity();
        if (!$client instanceof Client) {
            return;
        }

        if (!$client->getPublicId()) {
            $client->setPublicId($this->gen->generate());
        }

        $client->calculateAgeExpiration();
    }

    public function preUpdate(PreUpdateEventArgs $event)
    {
        $client = $event->getEntity();
        if (!$client instanceof Client) {
            return;
        }

        $email = (new TemplatedEmail())
            ->addFrom('andrew@koebbe.com')
            ->addTo('andrew@koebbe.com')
            ->subject('Order Updated')
            ->htmlTemplate('emails/order-update.html.twig')
            ->text('Something here')
            ->context([
                'client' => $client,
                'partner' => $client->getPartner(),
                'contact' =>  $client->getPartner()->getContacts()->first()
            ]);

        $this->mailer->send($email);

        $client->calculateAgeExpiration();
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postLoad,
            Events::prePersist,
            Events::preUpdate,
        ];
    }
}
