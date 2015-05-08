<?php

namespace Itk\ExchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A resource. Is hooked up with a mail in Exchange.
 *
 * @ORM\Table(name="exchange_resource")
 * @ORM\Entity(repositoryClass="Itk\ExchangeBundle\Entity\ResourceRepository")
 */
class Resource {
  /**
   * Resource mail
   *
   * @ORM\Column(name="mail", type="string")
   * @ORM\Id
   */
  protected $mail;

  /**
   * Resource name
   *
   * @ORM\Column(name="name", type="string")
   */
  protected $name;

  /**
   * Bookings of the resource
   *
   * @ORM\OneToMany(targetEntity="Booking", mappedBy="resource")
   **/
  protected $bookings;

  /**
   * Constructor.
   *
   * @param string|null $mail
   *   Resource mail address.
   * @param string|null $name
   *   Resource name.
   */
  public function __construct($mail = NULL, $name = NULL) {
    $this->mail = $mail;
    $this->name = $name;
    $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Set name
   *
   * @param string $name
   *
   * @return Resource
   */
  public function setName($name) {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Set mail
   *
   * @param string $mail
   *
   * @return Resource
   */
  public function setMail($mail) {
    $this->mail = $mail;

    return $this;
  }

  /**
   * Get mail
   *
   * @return string
   */
  public function getMail() {
    return $this->mail;
  }

  /**
   * Add bookings
   *
   * @param \Koba\MainBundle\Entity\Booking $bookings
   *
   * @return Resource
   */
  public function addBooking(\Koba\MainBundle\Entity\Booking $bookings) {
    $this->bookings[] = $bookings;
    return $this;
  }
  /**
   * Remove bookings
   *
   * @param \Koba\MainBundle\Entity\Booking $bookings
   */
  public function removeBooking(\Koba\MainBundle\Entity\Booking $bookings) {
    $this->bookings->removeElement($bookings);
  }
  /**
   * Get bookings
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getBookings() {
    return $this->bookings;
  }
}
