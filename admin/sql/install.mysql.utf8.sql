DROP TABLE IF EXISTS `#__etdnewsletter_emails`;
CREATE TABLE `#__etdnewsletter_emails` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `#__etdnewsletter_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`);


ALTER TABLE `#__etdnewsletter_emails`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;