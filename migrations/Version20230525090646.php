<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525090646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE blogs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blogs (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL COMMENT \'主键\', author VARCHAR(50) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'作者\', summary VARCHAR(100) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'摘要\', image VARCHAR(100) CHARACTER SET utf8 DEFAULT \'\' NOT NULL COLLATE `utf8_general_ci` COMMENT \'主图\', content TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci` COMMENT \'内容\', status TINYINT(1) DEFAULT \'1\' NOT NULL COMMENT \'状态：1 正常，2 删除\', created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'创建时间\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'更新时间\', INDEX summary (summary), INDEX updated_at (updated_at), INDEX author (author), INDEX created_at (created_at), INDEX status (status), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'博客表\' ');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
