<?php

class Transaction
{
    private $id;
    private $outlet_id;
    private $created;
    private $amount;
    private $title;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getOutletId()
    {
        return $this->outlet_id;
    }

    /**
     * @param mixed $outlet_id
     */
    public function setOutletId($outlet_id): void
    {
        $this->outlet_id = $outlet_id;
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

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function print(): array
    {
        return array(
            $this->id,
            $this->outlet_id,
            $this->created->format('Y-m-d H:i:s'),
            $this->amount,
            $this->title
        );
    }

}