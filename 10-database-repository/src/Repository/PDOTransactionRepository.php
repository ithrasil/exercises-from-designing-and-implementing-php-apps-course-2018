<?php

namespace Repository;

use ITransactionRepository;
use Money\Currency;
use Money\Money;
use PDO;
use Transaction;

class PDOTransactionRepository implements ITransactionRepository
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function get(string $transactionId): Transaction
    {
        $pdo = $this->prepareGetQuery();
        $pdo->execute(
            array(
                ':transactionId' => $transactionId
            )
        );
        $transaction = $pdo->fetch();

        return new Transaction(
            $transactionId,
            new Money($transaction["amount"], new Currency($transaction["currency"])),
            $transaction["fromAccount"],
            $transaction["toAccount"],
            $transaction["status"]
        );
    }

    private function prepareGetQuery()
    {
        return $this->connection->prepare("SELECT * FROM transaction WHERE uuid = :transactionId");
    }

    public function save(Transaction $transaction): void
    {
        $pdo = $this->prepareSaveQuery();
        $pdo->execute(
            array(
                ':uuid' => $transaction->getUuid(),
                ':amount' => $transaction->getAmount()->getAmount(),
                ':currency' => $transaction->getAmount()->getCurrency(),
                ':fromAccount' => $transaction->getFromAccount(),
                ':toAccount' => $transaction->getToAccount(),
                ':status' => $transaction->getStatus()
            )
        );
    }

    private function prepareSaveQuery()
    {
        return $this->connection->prepare("INSERT INTO transaction VALUES(:uuid, :amount, :currency, :fromAccount, :toAccount, :status)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    }

}