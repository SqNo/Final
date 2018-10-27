<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180905152203 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, sinister_id INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_47CC8C923E67426B (sinister_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, number INT NOT NULL, description VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_E98F2859783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coworker (id INT NOT NULL, name VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guarantee (id INT AUTO_INCREMENT NOT NULL, contract_id INT NOT NULL, name VARCHAR(45) NOT NULL, INDEX IDX_589198D82576E0FD (contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manager (id INT NOT NULL, siege_id INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, INDEX IDX_FA2425B9BF006E8B (siege_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, manager_id INT NOT NULL, name VARCHAR(45) NOT NULL, INDEX IDX_D79F6B11783E3463 (manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE siege (id INT NOT NULL, name VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sinister (id INT AUTO_INCREMENT NOT NULL, guarantee_id INT NOT NULL, description VARCHAR(255) NOT NULL, entry_date DATETIME NOT NULL, INDEX IDX_73FC7B36DB4B0220 (guarantee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C923E67426B FOREIGN KEY (sinister_id) REFERENCES sinister (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id)');
        $this->addSql('ALTER TABLE coworker ADD CONSTRAINT FK_68C85AFCBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE guarantee ADD CONSTRAINT FK_589198D82576E0FD FOREIGN KEY (contract_id) REFERENCES contract (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9BF006E8B FOREIGN KEY (siege_id) REFERENCES siege (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B9BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11783E3463 FOREIGN KEY (manager_id) REFERENCES manager (id)');
        $this->addSql('ALTER TABLE siege ADD CONSTRAINT FK_6706B4F7BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sinister ADD CONSTRAINT FK_73FC7B36DB4B0220 FOREIGN KEY (guarantee_id) REFERENCES guarantee (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE guarantee DROP FOREIGN KEY FK_589198D82576E0FD');
        $this->addSql('ALTER TABLE coworker DROP FOREIGN KEY FK_68C85AFCBF396750');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B9BF396750');
        $this->addSql('ALTER TABLE siege DROP FOREIGN KEY FK_6706B4F7BF396750');
        $this->addSql('ALTER TABLE sinister DROP FOREIGN KEY FK_73FC7B36DB4B0220');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859783E3463');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11783E3463');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B9BF006E8B');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C923E67426B');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE coworker');
        $this->addSql('DROP TABLE guarantee');
        $this->addSql('DROP TABLE manager');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE siege');
        $this->addSql('DROP TABLE sinister');
    }
}
