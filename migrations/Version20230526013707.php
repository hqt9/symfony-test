<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526013707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX summary ON blogs');
        $this->addSql('DROP INDEX updated_at ON blogs');
        $this->addSql('DROP INDEX author ON blogs');
        $this->addSql('DROP INDEX created_at ON blogs');
        $this->addSql('DROP INDEX status ON blogs');
        $this->addSql('ALTER TABLE blogs CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE author author VARCHAR(50) NOT NULL, CHANGE summary summary VARCHAR(100) NOT NULL, CHANGE image image VARCHAR(100) NOT NULL, CHANGE content content LONGTEXT NOT NULL, CHANGE status status INT NOT NULL, CHANGE created_at created_at VARCHAR(255) NOT NULL, CHANGE updated_at updated_at VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE blogs CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'主键\', CHANGE author author VARCHAR(50) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'作者\', CHANGE content content TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci` COMMENT \'内容\', CHANGE summary summary VARCHAR(100) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'摘要\', CHANGE image image VARCHAR(100) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'主图\', CHANGE status status TINYINT(1) DEFAULT \'1\' NOT NULL COMMENT \'状态：1 正常，2 删除\', CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'创建时间\', CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'更新时间\'');
        $this->addSql('CREATE INDEX summary ON blogs (summary)');
        $this->addSql('CREATE INDEX updated_at ON blogs (updated_at)');
        $this->addSql('CREATE INDEX author ON blogs (author)');
        $this->addSql('CREATE INDEX created_at ON blogs (created_at)');
        $this->addSql('CREATE INDEX status ON blogs (status)');
    }
}
