<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Length(min=2, max=100)
 */
private $username;

/**
 * @var string|null
 * @Assert\Email()
 */
private $email;

/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Email()
 */
private $information;


/**
 * @var string|null
 */
private $subject;


/**
 * @var string|null
 * @Assert\NotBlank()
 * @Assert\Length(min=25)
 */
private $message;

public function __toString()
    {
        return $this->username;

        return $this->email;
    }


/**
 * Get the value of username
 *
 * @return  string|null
 */ 
public function getUsername()
{
return $this->username;
}

/**
 * Set the value of username
 *
 * @param  string|null  $username
 *
 * @return  self
 */ 
public function setUsername($username)
{
$this->username = $username;

return $this;
}

/**
 * Get the value of email
 *
 * @return  string|null
 */ 
public function getEmail()
{
return $this->email;
}

/**
 * Set the value of email
 *
 * @param  string|null  $email
 *
 * @return  self
 */ 
public function setEmail($email)
{
$this->email = $email;

return $this;
}

/**
 * Get the value of message
 *
 * @return  string|null
 */ 
public function getMessage()
{
return $this->message;
}

/**
 * Set the value of message
 *
 * @param  string|null  $message
 *
 * @return  self
 */ 
public function setMessage($message)
{
$this->message = $message;

return $this;
}

/**
 * Get the value of subject
 *
 * @return  string|null
 */ 
public function getSubject()
{
return $this->subject;
}

/**
 * Set the value of subject
 *
 * @param  string|null  $subject
 *
 * @return  self
 */ 
public function setSubject($subject)
{
$this->subject = $subject;

return $this;
}


/**
 * Get the value of information
 *
 * @return  string|null
 */ 
public function getInformation()
{
return $this->information;
}

/**
 * Set the value of information
 *
 * @param  string|null  $information
 *
 * @return  self
 */ 
public function setInformation($information)
{
$this->information = $information;

return $this;
}
}