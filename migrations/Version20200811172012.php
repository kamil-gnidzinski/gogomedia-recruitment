<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200811172012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE generator (id INT AUTO_INCREMENT NOT NULL, generator_name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE generator_data (id INT AUTO_INCREMENT NOT NULL, generator_id_id INT NOT NULL, measurement_time DATETIME NOT NULL, current_power SMALLINT NOT NULL, INDEX IDX_57C90B8441D0D374 (generator_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, generator_id_id INT NOT NULL, report_date DATETIME NOT NULL, generator_power SMALLINT NOT NULL, INDEX IDX_C42F778441D0D374 (generator_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE generator_data ADD CONSTRAINT FK_57C90B8441D0D374 FOREIGN KEY (generator_id_id) REFERENCES generator (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778441D0D374 FOREIGN KEY (generator_id_id) REFERENCES generator (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generator_data DROP FOREIGN KEY FK_57C90B8441D0D374');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F778441D0D374');
        $this->addSql('DROP TABLE generator');
        $this->addSql('DROP TABLE generator_data');
        $this->addSql('DROP TABLE report');
    }
}
