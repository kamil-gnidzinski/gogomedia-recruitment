<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813015956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generator_data DROP FOREIGN KEY FK_57C90B8441D0D374');
        $this->addSql('DROP INDEX IDX_57C90B8441D0D374 ON generator_data');
        $this->addSql('ALTER TABLE generator_data ADD generator INT DEFAULT NULL, DROP generator_id_id');
        $this->addSql('ALTER TABLE generator_data ADD CONSTRAINT FK_57C90B84CAAE7B70 FOREIGN KEY (generator) REFERENCES generator (id)');
        $this->addSql('CREATE INDEX IDX_57C90B84CAAE7B70 ON generator_data (generator)');
        $this->addSql('CREATE INDEX idx_search ON generator_data (generator, measurement_time)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE generator_data DROP FOREIGN KEY FK_57C90B84CAAE7B70');
        $this->addSql('DROP INDEX IDX_57C90B84CAAE7B70 ON generator_data');
        $this->addSql('DROP INDEX idx_search ON generator_data');
        $this->addSql('ALTER TABLE generator_data ADD generator_id_id INT NOT NULL, DROP generator');
        $this->addSql('ALTER TABLE generator_data ADD CONSTRAINT FK_57C90B8441D0D374 FOREIGN KEY (generator_id_id) REFERENCES generator (id)');
        $this->addSql('CREATE INDEX IDX_57C90B8441D0D374 ON generator_data (generator_id_id)');
    }
}
