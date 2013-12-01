<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131126220110 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");

        $this->addSql("RENAME TABLE financial_transaction TO financial_transactions");
        $this->addSql("RENAME TABLE payment TO payments");
        $this->addSql("RENAME TABLE payment_instruction TO payment_instructions");
        $this->addSql("RENAME TABLE `order` TO `purchase_order`");

        $this->addSql("DROP TABLE article");
        $this->addSql("DROP TABLE article_i18n");
        $this->addSql("DROP TABLE program_i18n");
        $this->addSql("DROP TABLE organization");
        $this->addSql("DROP TABLE organization_i18n");

        $this->addSql("DROP TABLE extended_data");
        $this->addSql("DROP TABLE propel_migration");
        $this->addSql("DROP TABLE address");
        $this->addSql("DROP TABLE category");
        $this->addSql("DROP TABLE credit");
        $this->addSql("DROP TABLE fos_group");
        $this->addSql("DROP TABLE fos_user_group");
        $this->addSql("DROP TABLE friend");
        $this->addSql("DROP TABLE gallery");
        $this->addSql("DROP TABLE mail");
        $this->addSql("DROP TABLE mailingList");
        $this->addSql("DROP TABLE order_kit");
        $this->addSql("DROP TABLE partner_program");
        $this->addSql("DROP TABLE partner_voucher");
        $this->addSql("DROP TABLE picture");
        $this->addSql("DROP TABLE pre_registration");
        $this->addSql("DROP TABLE reforestation_voucher");
        $this->addSql("DROP TABLE tree");
        $this->addSql("DROP TABLE user_profile");
        $this->addSql("DROP TABLE user_tree");
        $this->addSql("DROP TABLE voucher_category");
        $this->addSql("DROP TABLE voucher_tree");
        $this->addSql("DROP TABLE waiting_list");

        $this->addSql("ALTER TABLE acl_classes ENGINE=InnoDB");
        $this->addSql("ALTER TABLE acl_entries ENGINE=InnoDB");
        $this->addSql("ALTER TABLE acl_object_identities ENGINE=InnoDB");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ENGINE=InnoDB");
        $this->addSql("ALTER TABLE acl_security_identities ENGINE=InnoDB");
        $this->addSql("ALTER TABLE classroom ENGINE=InnoDB");
        $this->addSql("ALTER TABLE classroom_picture ENGINE=InnoDB");
        $this->addSql("ALTER TABLE donation ENGINE=InnoDB");
        $this->addSql("ALTER TABLE education_voucher ENGINE=InnoDB");
        $this->addSql("ALTER TABLE financial_transactions ENGINE=InnoDB");
        $this->addSql("ALTER TABLE fos_user ENGINE=InnoDB");
        $this->addSql("ALTER TABLE partner ENGINE=InnoDB");
        $this->addSql("ALTER TABLE partner_logo ENGINE=InnoDB");
        $this->addSql("ALTER TABLE payment_instructions ENGINE=InnoDB");
        $this->addSql("ALTER TABLE payments ENGINE=InnoDB");
        $this->addSql("ALTER TABLE purchase_order ENGINE=InnoDB");
        $this->addSql("ALTER TABLE school ENGINE=InnoDB");
        $this->addSql("ALTER TABLE voucher ENGINE=InnoDB");
        $this->addSql("ALTER TABLE program ENGINE=InnoDB");

        $this->addSql('UPDATE `program` SET `organization_id` = NULL');

        // Users
        $this->addSql("ALTER TABLE fos_user ADD credit DOUBLE PRECISION NOT NULL, ADD accept_newsletter TINYINT(1) NOT NULL, ADD locale VARCHAR(7) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE username_canonical username_canonical VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE email_canonical email_canonical VARCHAR(255) NOT NULL, CHANGE enabled enabled TINYINT(1) NOT NULL, CHANGE locked locked TINYINT(1) NOT NULL, CHANGE expired expired TINYINT(1) NOT NULL, CHANGE credentials_expired credentials_expired TINYINT(1) NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)'");
        $this->addSql("ALTER TABLE partner CHANGE title title VARCHAR(255) NOT NULL");
        $this->addSql("ALTER TABLE partner ADD CONSTRAINT FK_312B3E16A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE");

        // Vouchers
        $this->addSql("ALTER TABLE voucher ADD discriminator VARCHAR(255) NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D852EE6EC4 FOREIGN KEY (used_by) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D87E3C61F9 FOREIGN KEY (owner_id) REFERENCES fos_user (id)");
        $this->addSql("DROP INDEX education_voucher_FI_1 ON education_voucher");
        $this->addSql("ALTER TABLE education_voucher DROP voucher_id, CHANGE id id INT NOT NULL");
        $this->addSql("ALTER TABLE education_voucher ADD CONSTRAINT FK_FB6CA00BF396750 FOREIGN KEY (id) REFERENCES voucher (id) ON DELETE CASCADE");

        $this->addSql("UPDATE `voucher` SET `discriminator` = 'education_voucher'");

        $this->addSql("CREATE TABLE organization (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(128) NOT NULL, title VARCHAR(128) NOT NULL, summary LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(128) DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, summary LONGTEXT DEFAULT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_23A0E66989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:array)', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, gallery_id INT NOT NULL, src VARCHAR(255) NOT NULL, INDEX IDX_16DB4F894E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE article_i18n (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX article_i18n_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, sender VARCHAR(255) NOT NULL, reply VARCHAR(255) NOT NULL, sent_at DATETIME NOT NULL, isForced TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE mailingList (id INT AUTO_INCREMENT NOT NULL, email_address VARCHAR(255) NOT NULL, is_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_7B1AC3EDB08E074E (email_address), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE voucher_category (id INT AUTO_INCREMENT NOT NULL, price NUMERIC(10, 0) NOT NULL, credit INT NOT NULL, is_purchasable TINYINT(1) NOT NULL, is_partner_only TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, street_line_1 VARCHAR(50) NOT NULL, street_line_2 VARCHAR(50) DEFAULT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE user_tree (user_id INT NOT NULL, tree_id INT NOT NULL, INDEX IDX_CDBF1215A76ED395 (user_id), INDEX IDX_CDBF121578B64A2 (tree_id), PRIMARY KEY(user_id, tree_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE friend (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, email VARCHAR(255) NOT NULL, is_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_55EEAC61E7927C74 (email), INDEX IDX_55EEAC61A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE pre_registration (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(128) NOT NULL, accept_newsletter TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_A2FEF1B9E7927C74 (email), UNIQUE INDEX UNIQ_A2FEF1B9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE reforestation_voucher (id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_10106E6212469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE voucher_tree (voucher_id INT NOT NULL, tree_id INT NOT NULL, INDEX IDX_B653DE6428AA1B6F (voucher_id), INDEX IDX_B653DE6478B64A2 (tree_id), PRIMARY KEY(voucher_id, tree_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE partner_voucher (partner_id INT NOT NULL, voucher_id INT NOT NULL, INDEX IDX_D478C6C59393F8FE (partner_id), INDEX IDX_D478C6C528AA1B6F (voucher_id), PRIMARY KEY(partner_id, voucher_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE partner_program (partner_id INT NOT NULL, program_id INT NOT NULL, number INT NOT NULL, hardcode INT NOT NULL, INDEX IDX_550714999393F8FE (partner_id), INDEX IDX_550714993EB8070A (program_id), PRIMARY KEY(partner_id, program_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE program_i18n (id INT AUTO_INCREMENT NOT NULL, object_id INT DEFAULT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_F2B04D91232D562B (object_id), INDEX program_i18n_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE tree (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, INDEX IDX_B73E5EDC3EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE organization_i18n (id INT AUTO_INCREMENT NOT NULL, object_id INT DEFAULT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_C65F260B232D562B (object_id), INDEX organization_i18n_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE order_kit (id INT NOT NULL, address_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, kits_number INT NOT NULL, INDEX IDX_1BCFD778F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE waiting_list (id INT AUTO_INCREMENT NOT NULL, address_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, kits_number INT NOT NULL, INDEX IDX_E4F3965BF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE credits (id INT AUTO_INCREMENT NOT NULL, payment_instruction_id INT NOT NULL, payment_id INT DEFAULT NULL, attention_required TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, credited_amount NUMERIC(10, 5) NOT NULL, crediting_amount NUMERIC(10, 5) NOT NULL, reversing_amount NUMERIC(10, 5) NOT NULL, state SMALLINT NOT NULL, target_amount NUMERIC(10, 5) NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4117D17E8789B572 (payment_instruction_id), INDEX IDX_4117D17E4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");

        // Payment
        $this->addSql("DROP INDEX financial_transaction_FI_3 ON financial_transactions");
        $this->addSql("ALTER TABLE financial_transactions ADD extended_data LONGTEXT DEFAULT NULL COMMENT '(DC2Type:extended_payment_data)', DROP extended_data_id, CHANGE processed_amount processed_amount NUMERIC(10, 5) NOT NULL, CHANGE requested_amount requested_amount NUMERIC(10, 5) NOT NULL, CHANGE state state SMALLINT NOT NULL, CHANGE transaction_type transaction_type SMALLINT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE financial_transactions ADD CONSTRAINT FK_1353F2D9CE062FF9 FOREIGN KEY (credit_id) REFERENCES credits (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE financial_transactions ADD CONSTRAINT FK_1353F2D94C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON DELETE CASCADE");
        $this->addSql("DROP INDEX payment_instruction_FI_1 ON payment_instructions");
        $this->addSql("ALTER TABLE payment_instructions ADD extended_data LONGTEXT NOT NULL COMMENT '(DC2Type:extended_payment_data)', DROP extended_data_id, CHANGE state state SMALLINT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE payments CHANGE approved_amount approved_amount NUMERIC(10, 5) NOT NULL, CHANGE approving_amount approving_amount NUMERIC(10, 5) NOT NULL, CHANGE credited_amount credited_amount NUMERIC(10, 5) NOT NULL, CHANGE crediting_amount crediting_amount NUMERIC(10, 5) NOT NULL, CHANGE deposited_amount deposited_amount NUMERIC(10, 5) NOT NULL, CHANGE depositing_amount depositing_amount NUMERIC(10, 5) NOT NULL, CHANGE reversing_approved_amount reversing_approved_amount NUMERIC(10, 5) NOT NULL, CHANGE reversing_credited_amount reversing_credited_amount NUMERIC(10, 5) NOT NULL, CHANGE reversing_deposited_amount reversing_deposited_amount NUMERIC(10, 5) NOT NULL, CHANGE target_amount target_amount NUMERIC(10, 5) NOT NULL, CHANGE expiration_date expiration_date DATETIME DEFAULT NULL, CHANGE state state SMALLINT NOT NULL, CHANGE attention_required attention_required TINYINT(1) NOT NULL, CHANGE expired expired TINYINT(1) NOT NULL, CHANGE payment_instruction_id payment_instruction_id INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE payments ADD CONSTRAINT FK_65D29B328789B572 FOREIGN KEY (payment_instruction_id) REFERENCES payment_instructions (id) ON DELETE CASCADE");

        $this->addSql('UPDATE `payment_instructions` SET `extended_data` = \'a:3:{s:10:"return_url";a:3:{i:0;s:0:"";i:1;b:1;i:2;b:1;}s:10:"cancel_url";a:3:{i:0;s:0:"";i:1;b:1;i:2;b:1;}s:22:"express_checkout_token";a:3:{i:0;s:0:"";i:1;b:1;i:2;b:1;}}\'');
        $this->addSql('UPDATE `payment_instructions` SET `state` = state + 1');
        $this->addSql('UPDATE `financial_transactions` SET `state` = state + 1');
        $this->addSql('UPDATE `payments` SET `state` = state + 1');

        // Orders
        $this->addSql("DELETE FROM `purchase_order` WHERE payment_instruction_id NOT IN (SELECT pi.id FROM payment_instructions pi)");
        $this->addSql("ALTER TABLE purchase_order DROP INDEX order_FI_1, ADD UNIQUE INDEX UNIQ_21E210B28789B572 (payment_instruction_id)");
        $this->addSql("ALTER TABLE purchase_order ADD discriminator VARCHAR(255) NOT NULL, CHANGE payment_instruction_id payment_instruction_id INT DEFAULT NULL");
        $this->addSql("ALTER TABLE purchase_order ADD CONSTRAINT FK_21E210B28789B572 FOREIGN KEY (payment_instruction_id) REFERENCES payment_instructions (id)");
        $this->addSql("UPDATE `purchase_order` SET `discriminator` = 'education_donation'");

        $this->addSql("DROP INDEX donation_FI_1 ON donation");
        $this->addSql("DELETE FROM `donation` WHERE order_id NOT IN (SELECT po.id FROM purchase_order po)");
        $this->addSql("ALTER TABLE donation DROP order_id, CHANGE id id INT NOT NULL, CHANGE is_anonymous is_anonymous TINYINT(1) NOT NULL");
        $this->addSql("ALTER TABLE donation ADD CONSTRAINT FK_31E581A0BF396750 FOREIGN KEY (id) REFERENCES purchase_order (id) ON DELETE CASCADE");

        // ACL
        $this->addSql("ALTER TABLE acl_classes CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL");
        $this->addSql("ALTER TABLE acl_security_identities CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL");
        $this->addSql("DROP INDEX acl_object_identities_U_1 ON acl_object_identities");
        $this->addSql("ALTER TABLE acl_object_identities CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE class_id class_id INT UNSIGNED NOT NULL, CHANGE object_identifier object_identifier VARCHAR(100) NOT NULL, CHANGE parent_object_identity_id parent_object_identity_id INT UNSIGNED DEFAULT NULL, CHANGE entries_inheriting entries_inheriting TINYINT(1) NOT NULL");
        $this->addSql("ALTER TABLE acl_object_identities ADD CONSTRAINT FK_9407E54977FA751A FOREIGN KEY (parent_object_identity_id) REFERENCES acl_object_identities (id)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_9407E5494B12AD6EA000B10 ON acl_object_identities (object_identifier, class_id)");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors CHANGE object_identity_id object_identity_id INT UNSIGNED NOT NULL, CHANGE ancestor_id ancestor_id INT UNSIGNED NOT NULL");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE2993D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_object_identity_ancestors ADD CONSTRAINT FK_825DE299C671CEA1 FOREIGN KEY (ancestor_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("CREATE INDEX IDX_825DE2993D9AB4A6 ON acl_object_identity_ancestors (object_identity_id)");
        $this->addSql("ALTER TABLE acl_entries CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE class_id class_id INT UNSIGNED NOT NULL, CHANGE object_identity_id object_identity_id INT UNSIGNED DEFAULT NULL, CHANGE security_identity_id security_identity_id INT UNSIGNED NOT NULL, CHANGE ace_order ace_order SMALLINT UNSIGNED NOT NULL, CHANGE audit_success audit_success TINYINT(1) NOT NULL, CHANGE audit_failure audit_failure TINYINT(1) NOT NULL");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806EA000B10 FOREIGN KEY (class_id) REFERENCES acl_classes (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B8063D9AB4A6 FOREIGN KEY (object_identity_id) REFERENCES acl_object_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");
        $this->addSql("ALTER TABLE acl_entries ADD CONSTRAINT FK_46C8B806DF9183C9 FOREIGN KEY (security_identity_id) REFERENCES acl_security_identities (id) ON UPDATE CASCADE ON DELETE CASCADE");

        $this->addSql("ALTER TABLE classroom CHANGE name name VARCHAR(30) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE slug slug VARCHAR(30) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE program ADD title VARCHAR(128) NOT NULL, ADD summary LONGTEXT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, CHANGE added_trees added_trees INT NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL");
        $this->addSql("ALTER TABLE partner_logo CHANGE src src VARCHAR(255) DEFAULT NULL");
        $this->addSql("ALTER TABLE school DROP latitude, DROP longitude, CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL");
        $this->addSql("ALTER TABLE classroom_picture CHANGE created_at created_at DATETIME NOT NULL");

        $this->addSql("ALTER TABLE picture ADD CONSTRAINT FK_16DB4F894E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)");
        $this->addSql("ALTER TABLE user_tree ADD CONSTRAINT FK_CDBF1215A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)");
        $this->addSql("ALTER TABLE user_tree ADD CONSTRAINT FK_CDBF121578B64A2 FOREIGN KEY (tree_id) REFERENCES tree (id)");
        $this->addSql("ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE reforestation_voucher ADD CONSTRAINT FK_10106E6212469DE2 FOREIGN KEY (category_id) REFERENCES voucher_category (id)");
        $this->addSql("ALTER TABLE reforestation_voucher ADD CONSTRAINT FK_10106E62BF396750 FOREIGN KEY (id) REFERENCES voucher (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE voucher_tree ADD CONSTRAINT FK_B653DE6428AA1B6F FOREIGN KEY (voucher_id) REFERENCES reforestation_voucher (id)");
        $this->addSql("ALTER TABLE voucher_tree ADD CONSTRAINT FK_B653DE6478B64A2 FOREIGN KEY (tree_id) REFERENCES tree (id)");
        $this->addSql("ALTER TABLE partner_voucher ADD CONSTRAINT FK_D478C6C59393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)");
        $this->addSql("ALTER TABLE partner_voucher ADD CONSTRAINT FK_D478C6C528AA1B6F FOREIGN KEY (voucher_id) REFERENCES reforestation_voucher (id)");
        $this->addSql("ALTER TABLE partner_program ADD CONSTRAINT FK_550714999393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE partner_program ADD CONSTRAINT FK_550714993EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE program ADD CONSTRAINT FK_92ED778432C8A3DE FOREIGN KEY (organization_id) REFERENCES organization (id) ON DELETE SET NULL");
        $this->addSql("ALTER TABLE program_i18n ADD CONSTRAINT FK_F2B04D91232D562B FOREIGN KEY (object_id) REFERENCES program (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE tree ADD CONSTRAINT FK_B73E5EDC3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)");
        $this->addSql("ALTER TABLE organization_i18n ADD CONSTRAINT FK_C65F260B232D562B FOREIGN KEY (object_id) REFERENCES organization (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE partner_logo ADD CONSTRAINT FK_B4BAA90B9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE order_kit ADD CONSTRAINT FK_1BCFD778F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)");
        $this->addSql("ALTER TABLE order_kit ADD CONSTRAINT FK_1BCFD778BF396750 FOREIGN KEY (id) REFERENCES purchase_order (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE classroom ADD CONSTRAINT FK_497D309DC32A47EE FOREIGN KEY (school_id) REFERENCES school (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE classroom ADD CONSTRAINT FK_497D309DA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE classroom ADD CONSTRAINT FK_497D309D9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) ON DELETE SET NULL");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_497D309D5E237E06 ON classroom (name)");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_F99EDABB5E237E06 ON school (name)");
        $this->addSql("ALTER TABLE waiting_list ADD CONSTRAINT FK_E4F3965BF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE classroom_picture ADD CONSTRAINT FK_9C2A8EA16278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE classroom_picture ADD CONSTRAINT FK_9C2A8EA13EB8070A FOREIGN KEY (program_id) REFERENCES program (id)");
        $this->addSql("ALTER TABLE credits ADD CONSTRAINT FK_4117D17E8789B572 FOREIGN KEY (payment_instruction_id) REFERENCES payment_instructions (id) ON DELETE CASCADE");
        $this->addSql("ALTER TABLE credits ADD CONSTRAINT FK_4117D17E4C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON DELETE CASCADE");
    }

    public function down(Schema $schema)
    {
    }
}