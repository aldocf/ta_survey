<?php
/**
 * Created by PhpStorm.
 * User: Ariahari's
 * Date: 4/18/2018
 * Time: 7:30 PM
 */

class Feedback
{
    private $idFeedback;
    private $user;
    private $feedback;
    private $created;

    /**
     * @return mixed
     */
    public function getIdFeedback()
    {
        return $this->idFeedback;
    }

    /**
     * @param mixed $idFeedback
     */
    public function setIdFeedback($idFeedback): void
    {
        $this->idFeedback = $idFeedback;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback): void
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }


}