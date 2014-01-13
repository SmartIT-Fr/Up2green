<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140113213226 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE classroom_picture DROP FOREIGN KEY FK_9C2A8EA16278D5A8");
        $this->addSql("ALTER TABLE classroom_picture ADD CONSTRAINT FK_9C2A8EA16278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE classroom_picture DROP FOREIGN KEY FK_9C2A8EA16278D5A8");
        $this->addSql("ALTER TABLE classroom_picture ADD CONSTRAINT FK_9C2A8EA16278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)");
    }
}
