<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230323035407 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE purchase_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE target_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE purchase (id INT NOT NULL, author_id INT DEFAULT NULL, target_id INT DEFAULT NULL, type_id INT DEFAULT NULL, datetime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sum INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6117D13BF675F31B ON purchase (author_id)');
        $this->addSql('CREATE INDEX IDX_6117D13B158E0B66 ON purchase (target_id)');
        $this->addSql('CREATE INDEX IDX_6117D13BC54C8C93 ON purchase (type_id)');
        $this->addSql('CREATE TABLE target (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8CDE572912469DE2 ON type (category_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B158E0B66 FOREIGN KEY (target_id) REFERENCES target (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE572912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE purchase_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE target_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13BF675F31B');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13B158E0B66');
        $this->addSql('ALTER TABLE purchase DROP CONSTRAINT FK_6117D13BC54C8C93');
        $this->addSql('ALTER TABLE type DROP CONSTRAINT FK_8CDE572912469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE target');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE "user"');
    }
}
