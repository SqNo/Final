<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180917134457 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE guarantee_participant (guarantee_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_57A58A55DB4B0220 (guarantee_id), INDEX IDX_57A58A559D1C3019 (participant_id), PRIMARY KEY(guarantee_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guarantee_participant ADD CONSTRAINT FK_57A58A55DB4B0220 FOREIGN KEY (guarantee_id) REFERENCES guarantee (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guarantee_participant ADD CONSTRAINT FK_57A58A559D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE guarantee_participant');
    }
}
