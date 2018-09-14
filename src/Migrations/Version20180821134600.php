<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180821134600 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE heading (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) NOT NULL, position INT NOT NULL, active TINYINT(1) DEFAULT \'0\' NOT NULL, subtitle VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, validated_at DATETIME DEFAULT NULL, validated TINYINT(1) DEFAULT \'0\' NOT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE heading_type (id INT AUTO_INCREMENT NOT NULL, heading_id INT DEFAULT NULL, name VARCHAR(45) NOT NULL, code VARCHAR(45) NOT NULL, INDEX IDX_5DA73AE062FE64EC (heading_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, heading_id INT DEFAULT NULL, title VARCHAR(45) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, position INT NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, validated_at DATETIME DEFAULT NULL, validated TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_23A0E6662FE64EC (heading_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE heading_type ADD CONSTRAINT FK_5DA73AE062FE64EC FOREIGN KEY (heading_id) REFERENCES heading (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6662FE64EC FOREIGN KEY (heading_id) REFERENCES heading (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE heading_type DROP FOREIGN KEY FK_5DA73AE062FE64EC');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6662FE64EC');
        $this->addSql('DROP TABLE heading');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE heading_type');
        $this->addSql('DROP TABLE article');
    }
}
