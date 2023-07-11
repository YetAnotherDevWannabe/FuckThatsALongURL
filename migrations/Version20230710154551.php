<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710154551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB893157BAE0F120');
        $this->addSql('DROP INDEX IDX_CB893157BAE0F120 ON info');
        $this->addSql('ALTER TABLE info CHANGE url_id_id url_id INT NOT NULL');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB89315781CFDAE7 FOREIGN KEY (url_id) REFERENCES url (id)');
        $this->addSql('CREATE INDEX IDX_CB89315781CFDAE7 ON info (url_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB89315781CFDAE7');
        $this->addSql('DROP INDEX IDX_CB89315781CFDAE7 ON info');
        $this->addSql('ALTER TABLE info CHANGE url_id url_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB893157BAE0F120 FOREIGN KEY (url_id_id) REFERENCES url (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CB893157BAE0F120 ON info (url_id_id)');
    }
}
