CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `name`, `password`, `firstname`, `lastname`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Demon', 'Stration'),
(2, 'elliot', '', 'Elliot', 'Alderson'),
(3, 'tyrell', '', 'Tyrell', 'Wellick'),
(4, 'angela', '', 'Angela', 'Moss'),
(5, 'darlene', '', 'Darlene', 'Alderson');

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_password_idx` (`id`,`name`);

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
