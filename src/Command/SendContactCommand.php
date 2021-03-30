<?php

namespace App\Command;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\services\ContactService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var ContactRepository
     */
    private $contactRepository;
    /**
     * @var ContactService
     */
    private $service;
    /**
     * @var UserRepository
     */
    private $userRepository;
    protected static $defaultName = 'peintre:send-mail';
    public function __construct(
        MailerInterface $mailer,
        ContactRepository $contactRepository,
        ContactService $service,
        UserRepository $userRepository
    )
    {
        parent::__construct();
        $this->mailer = $mailer;
        $this->contactRepository = $contactRepository;
        $this->service = $service;
        $this->userRepository = $userRepository;
    }

    public function configure()
    {
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $out = new SymfonyStyle($input,$output);
        $contacts = $this->contactRepository->findBy(['isSend' => false]);
        $adress = new Address($this->userRepository->getPeintre()->getEmail(),$this->userRepository->getPeintre()->getNom());
        foreach ($contacts as $contact)
        {
            $mail = (new Email())
                ->from($contact->getEmail())
                ->subject("Mail Contact peintre ".$contact->getNom())
                ->to($adress)
                ->setBody($contact->getMessage());
            try {
                $this->mailer->send($mail);
                $this->service->setSendedContact($contact);
                $out->success("Mail ".$contact->getNom()." envoyé  avec success ");
            } catch(\Exception $e) {
                $out->error("Erreur d'envoi de mail");
            }
        }
        return Command::SUCCESS;
    }
}
