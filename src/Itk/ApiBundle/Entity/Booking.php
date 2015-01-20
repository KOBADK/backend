<?php

namespace Itk\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\XmlRoot;

use Symfony\Component\Validator\Constraints AS Assert;

/**
 * A booking. The internal representation of a booking.
 *
 * @ORM\Entity
 * @ORM\Table(name="koba_booking")
 * @XmlRoot("booking")
 */
class Booking {
  /**
   * Internal booking ID
   *
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * Exchange event ID
   *
   * @ORM\Column(type="string", nullable=true)
   */
  protected $eid;

  /**
   * User that owns the booking
   *
   * @ORM\ManyToOne(targetEntity="User", inversedBy="bookings")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   *
   * @Assert\NotNull
   **/
  protected $user;

  /**
   * Resource that is booked
   *
   * @ORM\ManyToOne(targetEntity="Resource", inversedBy="bookings")
   * @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
   *
   * @Groups({"booking_create"})
   *
   * @Assert\NotNull
   * @Assert\Collection
   */
  protected $resource;

  /**
   * Start time
   * Must be in UTC
   *
   * @ORM\Column(name="start_datetime", type="datetime")
   *
   * @Assert\NotBlank
   */
  protected $startDateTime;

  /**
   * End time
   * Must be in UTC
   *
   * @ORM\Column(name="end_datetime", type="datetime")
   *
   * @Assert\NotBlank
   */
  protected $endDateTime;

  /**
   * Subject
   *
   * @ORM\Column(name="subject", type="string")
   *
   * @Assert\NotBlank
   */
  protected $subject;

  /**
   * Description
   *
   * @ORM\Column(name="description", type="text")
   *
   * @Assert\NotBlank
   */
  protected $description;

  /**
   * Completed
   *
   * @ORM\Column(name="completed", type="boolean", nullable=true)
   *
   * @Assert\NotBlank
   */
  protected $completed;

  /**
   * Status message for booking.
   *
   * @ORM\Column(name="status_message", type="string", nullable=true)
   */
  protected $statusMessage;

  /**
   * Constructor
   */
  public function __construct() {
    $this->resources = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set eid
   *
   * @param string $eid
   * @return Booking
   */
  public function setEid($eid) {
    $this->eid = $eid;

    return $this;
  }

  /**
   * Get eid
   *
   * @return string
   */
  public function getEid() {
    return $this->eid;
  }

  /**
   * Set user
   *
   * @param \Itk\ApiBundle\Entity\User $user
   * @return Booking
   */
  public function setUser(\Itk\ApiBundle\Entity\User $user = null) {
    $this->user = $user;

    return $this;
  }

  /**
   * Get user
   *
   * @return \Itk\ApiBundle\Entity\User
   */
  public function getUser() {
    return $this->user;
  }


  /**
   * Set startDateTime
   *
   * @param \DateTime $startDateTime
   * @return Booking
   */
  public function setStartDateTime($startDateTime) {
    $this->startDateTime = $startDateTime;

    return $this;
  }

  /**
   * Get startDateTime
   *
   * @return \DateTime
   */
  public function getStartDateTime() {
    return $this->startDateTime;
  }

  /**
   * Set endDateTime
   *
   * @param \DateTime $endDateTime
   * @return Booking
   */
  public function setEndDateTime($endDateTime) {
    $this->endDateTime = $endDateTime;

    return $this;
  }

  /**
   * Get endDateTime
   *
   * @return \DateTime
   */
  public function getEndDateTime() {
    return $this->endDateTime;
  }

  /**
   * Set subject
   *
   * @param string $subject
   * @return Booking
   */
  public function setSubject($subject) {
    $this->subject = $subject;

    return $this;
  }

  /**
   * Get subject
   *
   * @return string
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Set description
   *
   * @param string $description
   * @return Booking
   */
  public function setDescription($description) {
    $this->description = $description;

    return $this;
  }

  /**
   * Get description
   *
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Set completed
   *
   * @param boolean $completed
   * @return Booking
   */
  public function setCompleted($completed) {
    $this->completed = $completed;

    return $this;
  }

  /**
   * Get completed
   *
   * @return boolean
   */
  public function getCompleted() {
    return $this->completed;
  }

  /**
   * Set statusMessage
   *
   * @param string $statusMessage
   * @return Booking
   */
  public function setStatusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;

    return $this;
  }

  /**
   * Get statusMessage
   *
   * @return string
   */
  public function getStatusMessage() {
    return $this->statusMessage;
  }

  /**
   * Get start datetime formatted for a vCard.
   *
   * Complete date plus hours, minutes and seconds: YYYYMMDDThhmmssTZD (eg 19970716T192030+0100)
   *   T = Separator between date and time
   *   TZD  = time zone designator (Z or +hh:mm or -hh:mm)
   *   See http://www.w3.org/TR/NOTE-datetime where the separators have been removed
   */
  public function getStartDatetimeForVCard() {
    // TODO: Implement
  }

  /**
   * Get end datetime formatted for a vCard.
   *
   * Complete date plus hours, minutes and seconds: YYYYMMDDThhmmssTZD (eg 19970716T192030+0100)
   *   T = Separator between date and time
   *   TZD  = time zone designator (Z or +hh:mm or -hh:mm)
   *   See http://www.w3.org/TR/NOTE-datetime where the separators have been removed
   */
  public function getEndDatetimeForVCard() {
    // TODO: Implement
  }

  /**
   * Set resource
   *
   * @param \Itk\ApiBundle\Entity\Resource $resource
   * @return Booking
   */
  public function setResource(\Itk\ApiBundle\Entity\Resource $resource = null) {
    $this->resource = $resource;

    return $this;
  }

  /**
   * Get resource
   *
   * @return \Itk\ApiBundle\Entity\Resource
   */
  public function getResource() {
    return $this->resource;
  }
}
