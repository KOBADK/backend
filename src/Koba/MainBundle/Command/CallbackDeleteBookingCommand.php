<?php
/**
 * @file
 * Contains the command for CallbackBookingCommand.
 */
namespace Koba\MainBundle\Command;

use Guzzle\Http\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CallbackDeleteBookingCommand command.
 *
 * @package Koba\MainBundle\Command
 */
class CallbackDeleteBookingCommand extends ContainerAwareCommand {
  /**
   * Configure the command
   */
  protected function configure() {
    $this->setName('koba:booking:delete:callback')
      ->addArgument(
        'id',
        InputArgument::REQUIRED,
        'Which booking entity to delete?'
      )
      ->setDescription('Callback from delete in Exchange');
  }

  /**
   * Executes the command
   *
   * @param InputInterface $input
   * @param OutputInterface $output
   *
   * @return void
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $container = $this->getContainer();
    $doctrine = $container->get('doctrine');

    $id = $input->getArgument('id');
    $booking = $doctrine->getRepository('ItkExchangeBundle:Booking')->findOneBy(array('id' => $id));
    if (!$booking) {
      throw new NotFoundHttpException('booking with id:' . $id . ' not found');
    }

    $apiKey = $booking->getApiKey();
    $apiKey = $doctrine->getRepository('KobaMainBundle:ApiKey')->findOneBy(array('apiKey' => $apiKey));
    if (!$apiKey) {
      throw new NotFoundHttpException('api key not found');
    }

    $callback = $apiKey->getCallback();

    $client = new Client();

    $status = $booking->getStatus();
    if ($status === 'ACCEPTED') {
      $status = 'NOT CANCELLED';
    }

    $request = $client->post($callback . '?_format=json', array(
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
    ), array());
    $request->setBody(json_encode(
      array(
        'action' => 'DELETE',
        'koba_job_id' => $input->getOption('jms-job-id'),
        'status' => $status,
        'client_booking_id' => $booking->getClientBookingId(),
      )
    ));
    $request->send();
    
    $output->writeln("Callback success");
  }
}