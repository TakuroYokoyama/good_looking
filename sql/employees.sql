use good_looking;

CREATE TABLE `employees` (
	`person_no` int(3) NOT NULL,
	`name_initial` varchar(5) NOT NULL,
	`press_return` int(4),
	`img_name` varchar(255) NOT NULL,
	`del_flg` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `employees`
	ADD PRIMARY KEY (`person_no`);

ALTER TABLE `employees`
	MODIFY `person_no` int(3) NOT NULL AUTO_INCREMENT;