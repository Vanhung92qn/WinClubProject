-- BCrypt Migration: Create/recreate update_user_info with expanded param for BCrypt hashes.
-- BCrypt = 60 chars, username+","+bcrypt = ~81 chars. Expand NVARCHAR(100) → NVARCHAR(125).
-- Also handles missing procedure (if original SQL import failed due to permissions).

DROP PROCEDURE IF EXISTS `update_user_info`;
DELIMITER ;;
CREATE DEFINER=`root`@`%` PROCEDURE `update_user_info`(
    IN p_user_id INT(11),
    IN p_new NVARCHAR(125),
    IN p_type INT(11)
)
BEGIN
    IF p_type = 1 THEN
        UPDATE users SET avatar = p_new WHERE id = p_user_id;
    ELSEIF p_type = 2 THEN
        UPDATE users SET `password` = p_new WHERE id = p_user_id;
    ELSEIF p_type = 3 THEN
        UPDATE users SET identification = p_new WHERE id = p_user_id;
    ELSEIF p_type = 4 THEN
        UPDATE users SET mobile = p_new WHERE id = p_user_id;
    ELSEIF p_type = 5 THEN
        UPDATE users SET email = p_new WHERE id = p_user_id;
    ELSEIF p_type = 6 THEN
        UPDATE users SET nick_name = p_new WHERE id = p_user_id;
    ELSEIF p_type = 7 THEN
        UPDATE users SET `status` = p_new WHERE id = p_user_id;
    ELSEIF p_type = 8 THEN
        UPDATE users SET `status` = SUBSTRING_INDEX(p_new, ',', -1), `mobile` = SUBSTRING_INDEX(p_new, ',', 1) WHERE id = p_user_id;
    ELSEIF p_type = 9 THEN
        INSERT INTO users(user_name, `password`, vin, vin_total, xu, xu_total, avatar) VALUES(SUBSTRING_INDEX(p_new, ',', 1), SUBSTRING_INDEX(p_new, ',', -1), 0, 0, 500000, 500000, '0');
    ELSEIF p_type = 10 THEN
        INSERT INTO users(user_name, facebook_id, vin, vin_total, xu, xu_total, avatar) VALUES(CONCAT('FB_', UNIX_TIMESTAMP()), p_new, 0, 0, 500000, 500000, '0');
    ELSEIF p_type = 11 THEN
        INSERT INTO users(user_name, google_id, vin, vin_total, xu, xu_total, avatar) VALUES(CONCAT('GG_', UNIX_TIMESTAMP()), p_new, 0, 0, 500000, 500000, '0');
    ELSEIF p_type = 12 THEN
        UPDATE users SET login_otp = SUBSTRING_INDEX(p_new, ',', 1), `status` = SUBSTRING_INDEX(p_new, ',', -1) WHERE id = p_user_id;
    ELSEIF p_type = 13 THEN
        UPDATE users SET `status` = p_new, security_time = CURRENT_TIMESTAMP WHERE id = p_user_id;
    END IF;
END ;;
DELIMITER ;
