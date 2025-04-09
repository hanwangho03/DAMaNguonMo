-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 09, 2025 lúc 11:19 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `travela`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `passWord` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `booking`
--

CREATE TABLE `booking` (
  `bookingId` int(11) NOT NULL,
  `tourId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `numAdult` int(11) NOT NULL,
  `numChild` int(11) NOT NULL,
  `totalPrice` double NOT NULL,
  `bookingStatus` varchar(255) NOT NULL,
  `specialRequestes` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fullName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `booking`
--

INSERT INTO `booking` (`bookingId`, `tourId`, `userId`, `bookingDate`, `numAdult`, `numChild`, `totalPrice`, `bookingStatus`, `specialRequestes`, `email`, `phoneNumber`, `address`, `fullName`) VALUES
(1, 1, 1, '2025-03-18', 2, 3, 0, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(2, 1, 1, '2025-03-18', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(3, 1, 1, '2025-03-18', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(4, 1, 1, '2025-03-18', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(13, 1, 1, '2025-03-20', 3, 3, 73936962, 'confirmed', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(14, 1, 1, '2025-03-20', 7, 4, 135582615, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(15, 1, 1, '2025-03-30', 1, 3, 49270296, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(16, 1, 1, '2025-03-31', 4, 3, 86270295, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(17, 1, 1, '2025-03-31', 1, 3, 49270296, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(23, 1, 6, '2025-03-31', 1, 0, 12333333, 'pending', NULL, 'anhthuan060403@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(24, 1, 6, '2025-03-31', 1, 2, 36957975, 'pending', NULL, 'anhthuan060403@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(25, 1, 6, '2025-03-31', 1, 2, 36957975, 'failed', NULL, 'anhthuan0604@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(32, 8, 1, '2025-03-31', 1, 2, 8730000, 'confirmed', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(33, 8, 1, '2025-03-31', 1, 0, 3490000, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(34, 1, 1, '2025-03-31', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(35, 1, 1, '2025-04-08', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan'),
(36, 1, 1, '2025-04-08', 1, 2, 36957975, 'pending', NULL, 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'Tran Nhat Anh Thuan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chat`
--

CREATE TABLE `chat` (
  `chatId` int(10) NOT NULL,
  `useriId` int(10) NOT NULL,
  `adminId` int(10) NOT NULL,
  `messages` varchar(255) NOT NULL,
  `readStatus` enum('y','n') DEFAULT NULL COMMENT 'y: yes\r\nn: no',
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ipAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `checkout`
--

CREATE TABLE `checkout` (
  `checkoutId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` double NOT NULL,
  `paymentStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history`
--

CREATE TABLE `history` (
  `historyId` int(10) NOT NULL,
  `userId` int(11) NOT NULL,
  `tourId` int(11) NOT NULL,
  `actionType` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `imageId` int(11) NOT NULL,
  `tourId` int(11) NOT NULL,
  `imageURL` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`imageId`, `tourId`, `imageURL`, `description`, `uploadDate`) VALUES
(1, 1, 'travela\\public\\clients\\assets\\images\\gallery-tours\\mien-trung-4n3d-da-nang-hoi-an-ba-na-hue-2.png', '', '2025-03-20 16:58:27'),
(2, 1, 'travela\\public\\clients\\assets\\images\\gallery-tours\\mien-trung-4n3d-da-nang-hoi-an-ba-na-hue-3.png', '', '2025-03-20 16:58:41'),
(3, 1, 'travela\\public\\clients\\assets\\images\\gallery-tours\\mien-trung-4n3d-da-nang-hoi-an-ba-na-hue-4.png', '', '2025-03-20 16:58:49'),
(8, 6, 'travela\\public\\clients\\assets\\images\\gallery-tours\\gioi-thieu-sapa.jpg', '', '2025-03-23 06:46:02'),
(9, 6, 'travela\\public\\clients\\assets\\images\\gallery-tours\\lang-chu-tich-ho-chi-minh.png', '', '2025-03-23 06:46:31'),
(10, 6, 'travela\\public\\clients\\assets\\images\\gallery-tours\\dinh-fansipan-sapa.png', '', '2025-03-23 06:47:36'),
(11, 8, 'travela\\public\\clients\\assets\\images\\gallery-tours\\ba-na-hill-da-nang.png', '', '2025-03-23 06:48:39'),
(12, 1, 'travela\\public\\clients\\assets\\images\\gallery-tours\\hoi-an-viet-nam.png', '', '2025-03-23 06:49:21'),
(13, 1, 'travela\\public\\clients\\assets\\images\\gallery-tours\\khung-canh-da-nang-tu-tren-cao.png', '', '2025-03-23 06:49:57'),
(14, 9, 'travela\\public\\clients\\assets\\images\\gallery-tours\\nha-tho-da-sapa.png', '', '2025-03-23 06:51:00'),
(15, 9, 'travela\\public\\clients\\assets\\images\\gallery-tours\\vinh-ha-long.png', '', '2025-03-23 06:51:56'),
(16, 9, 'travela\\public\\clients\\assets\\images\\gallery-tours\\hang-mua-ninh-binh.png', '', '2025-03-23 06:52:38'),
(17, 10, 'travela\\public\\clients\\assets\\images\\gallery-tours\\suoi-cheonggyecheon-ve-dep-thien-nhien-giua-long-seoul.jpg', '', '2025-03-23 06:53:15'),
(18, 10, 'travela\\public\\clients\\assets\\images\\gallery-tours\\cung-dien-gyeongbokgung-han-quoc.jpg', '', '2025-03-23 06:53:49'),
(19, 10, 'travela\\public\\clients\\assets\\images\\gallery-tours\\blue-house.jpg', '', '2025-03-23 06:54:38'),
(20, 11, 'travela\\public\\clients\\assets\\images\\gallery-tours\\chua-thuyen-wat-yannawa-co-kinh-hon-200-tuoi.jpg', '', '2025-03-23 06:55:49'),
(21, 11, 'travela\\public\\clients\\assets\\images\\gallery-tours\\le-hoi-lightning-art-musemum-balloon-garden-thai-lan.jpg', '', '2025-03-23 06:56:25'),
(22, 11, 'travela\\public\\clients\\assets\\images\\gallery-tours\\toa-nha-86-tang-baiyoke-sky.jpg', '', '2025-03-23 06:58:46'),
(23, 12, 'travela\\public\\clients\\assets\\images\\gallery-tours\\toa-thap-cao-nhat-the-gioi-burj-khalifa.jpg', '', '2025-03-23 06:59:37'),
(24, 12, 'travela\\public\\clients\\assets\\images\\gallery-tours\\water-fountain-show.jpg', '', '2025-03-23 07:00:11'),
(25, 12, 'travela\\public\\clients\\assets\\images\\gallery-tours\\trai-nghiem-cuoi-lac-da.jpg', '', '2025-03-23 07:00:50'),
(26, 13, 'travela\\public\\clients\\assets\\images\\gallery-tours\\thap-truyen-hinh-minh-chau-phuong-dong.jpg', '', '2025-03-23 07:03:30'),
(27, 14, 'travela\\public\\clients\\assets\\images\\gallery-tours\\trung-tam-hoi-nghi-trien-lam-hong-kong.jpg', '', '2025-03-23 07:04:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `invoice`
--

CREATE TABLE `invoice` (
  `invoiceId` int(11) NOT NULL,
  `bookingId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `dateIssued` date DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `invoice`
--

INSERT INTO `invoice` (`invoiceId`, `bookingId`, `amount`, `dateIssued`, `details`) VALUES
(1, 8, 49312320, '2025-03-18', 'Hóa đơn cho booking tour  (Mã tour: 1)'),
(2, 9, 49312320, '2025-03-18', 'Hóa đơn cho booking tour  (Mã tour: 1)'),
(6, 13, 73936962, '2025-03-20', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(7, 14, 135582615, '2025-03-20', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(8, 15, 49270296, '2025-03-30', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(9, 16, 86270295, '2025-03-31', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(10, 17, 49270296, '2025-03-31', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(25, 32, 8730000, '2025-03-31', 'Hóa đơn cho booking tour ĐÀ NẴNG - CÙ LAO CHÀM -HỘI AN - BÀ NÀ\r\n (Mã tour: 8)'),
(26, 33, 3490000, '2025-03-31', 'Hóa đơn cho booking tour ĐÀ NẴNG - CÙ LAO CHÀM -HỘI AN - BÀ NÀ\r\n (Mã tour: 8)'),
(27, 34, 36957975, '2025-03-31', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(28, 35, 36957975, '2025-04-08', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)'),
(29, 36, 36957975, '2025-04-08', 'Hóa đơn cho booking tour ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA (Mã tour: 1)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `promotion`
--

CREATE TABLE `promotion` (
  `promotionId` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `discount` double NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) NOT NULL,
  `tourId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hidden` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`reviewId`, `tourId`, `userId`, `comment`, `timestamp`, `hidden`) VALUES
(1, 1, 1, 'Tour quá đã', '2025-03-18 21:30:28', 0),
(2, 1, 1, '123123', '2025-03-18 22:14:10', 0),
(3, 1, 1, '123', '2025-03-18 22:15:39', 0),
(4, 1, 1, '123', '2025-03-18 22:18:21', 0),
(5, 1, 1, '123', '2025-03-18 22:18:47', 0),
(6, 1, 1, '123', '2025-03-18 22:22:15', 0),
(7, 1, 1, 'Tour quá xịn', '2025-03-18 22:37:32', 0),
(8, 1, 1, 'Quá đẹp', '2025-03-23 14:22:25', 1),
(9, 1, 1, 'Tour 5 sao', '2025-03-19 20:14:22', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `timeline`
--

CREATE TABLE `timeline` (
  `timeLineId` int(11) NOT NULL,
  `tourId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `timeline`
--

INSERT INTO `timeline` (`timeLineId`, `tourId`, `title`, `description`) VALUES
(1, 1, 'ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA', 'Đón quý khách tại sân bay Tân Sơn Nhất, đáp chuyến bay khởi hành đi Đà Nẵng (các chuyến bay sớm dự kiến trước 07:30). Đến Đà Nẵng, xe và HDV đón khách. Khởi hành tham quan:\n\nĂn sáng buffet tại khách sạn. Khởi hành tham quan:\n\nCông viên vườn tượng Apec Đà Nẵng – công trình thể hiện tinh thần hội nhập quốc tế và khát vọng vươn xa của người dân Đà Nẵng.\n'),
(2, 1, 'ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA', 'Cầu Tình Yêu và check-in với biểu tượng Cá Chép Hóa Rồng, cầu Rồng Đà Nẵng…\r\nChùa Quan Thế Âm – tọa lạc tại chân núi Kim Sơn, một trong năm ngọn Ngũ Hành Sơn.\r\nLàng nghề điêu khắc đá và mua sắm tại cửa hàng đặc sản Miền Trung.\r\nĂn trưa. Khởi hành tham quan:\r\n\r\nPhố cổ Hội An – du khách tản bộ khám phá các công trình kiến trúc nổi tiếng: Chùa Cầu Nhật Bản, các ngôi nhà cổ hàng trăm tuổi, Hội Quán Phước Kiến, Xưởng thủ công mỹ nghệ. Phố cổ Hội An là quá khứ vàng son của một thương cảng sầm uất thời phong kiến.\r\nĂn tối. Khởi hành về lại Đà Nẵng. Tự do khám phá Đà Nẵng về đêm. Nghỉ đêm tại Đà Nẵng.'),
(3, 6, 'TP.HCM - HÀ NỘI \r\n', '\"Tập trung tại sân bay Tân Sơn Nhất đáp chuyến bay TP. HCM – HÀ NỘI. (Các chuyến bay dự kiến từ 06:00 – 09:00). Xe và HDV đón khách tại sân bay Nội Bài, đoàn di chuyển về trung tâm Hà Nội.\r\n\r\nĂn trưa. Nhận phòng khách sạn. Khởi hành tham quan:\r\n\r\nHồ Tây – Hồ lớn nhất Hà Nội, chùa Trấn Quốc, Hồ Gươm, đền Ngọc Sơn, cầu Thê Húc, chụp hình lưu niệm tại Nhà Thờ Lớn, Nhà Hát Lớn thành phố.\r\nThưởng thức bánh cốm Hàng Than, kem Tràng Tiền – Nét văn hóa ẩm thực đặc trưng rất riêng của Hà Nội.\r\nĂn tối. Tự do khám phá Hà Nội về đêm. Nghỉ đêm tại Hà Nội.\"\r\n'),
(4, 6, 'HÀ NỘI – LÀO CAI – SAPA\r\n', '\"Ăn sáng. Trả phòng. Tham quan Lăng Bác, thăm Phủ Chủ Tịch, nhà sàn, ao cá Bác Hồ, Chùa Một Cột, Văn Miếu – Quốc Tử Giám – trường đại học đầu tiên của Việt Nam.\r\n\r\nĂn trưa. Khởi hành đi SaPa – nơi mà người Pháp xưa gọi là “Kinh đô mùa hè của xứ Bắc Kỳ” theo tuyến đường cao tốc dài nhất Việt Nam 250km. Đến Lào Cai, dừng chân chụp ảnh lưu niệm tại cột mốc biên giới 102 – cửa khẩu Quốc tế Lào Cai. Đến SaPa, nhận phòng khách sạn.\r\n\r\nĂn tối. Thư giãn với liệu trình massage chân, mỗi khách được tặng 01 vé foot massage.\r\n\r\nTự do khám phá phố núi về đêm, tự do thưởng thức: Thắng Cố, cơm lam, lợn cắp nách, khoai nướng, bắp nướng… Nghỉ đêm tại thị trấn SaPa. \"\r\n'),
(5, 6, 'SAPA – BẢN CÁT CÁT – FANSIPAN\r\n', '\"Ăn sáng. Tham quan Bản Cát Cát – địa bàn cư trú của người H’Mông, ngắm cảnh hùng vĩ của núi rừng Tây Bắc, tham quan thác thuỷ điện Cát Cát do người Pháp xây dựng.\r\n\r\nĂn trưa. Di chuyển đến ga cáp treo Fansipan bắt đầu hành trình chinh phục Fansipan bằng hệ thống cáp treo 3 dây hiện đại nhất thế giới với cabin có sức chứa tới 35 khách. Vượt qua 639 bậc thang chinh phục đỉnh Fansipan trên độ cao 3.143m – nóc nhà của Đông Dương. (chi phí cáp treo tự túc)\r\n\r\nĂn tối. Tự do khám phá SaPa về đêm. Nghỉ đêm tại thị trấn SaPa.\"\r\n'),
(6, 6, 'SAPA – HÀ NỘI – TP. HCM\r\n', '\"Ăn sáng. Trả phòng. Khởi hành về lại Hà Nội.\r\n\r\nĂn trưa. Di chuyển ra sân bay Nội Bài đáp chuyến bay Hà Nội – TP. HCM.\r\n\r\n(Các chuyến bay dự kiến từ 16:30 – 17:30). Kết thúc chương trình tham quan!\r\n\r\nCác mốc thời gian có giá trị tham khảo, tùy theo điều kiện thực tế mà lịch trình có thể thay đổi cho phù hợp.\"\r\n'),
(7, 8, 'TP. HCM – ĐÀ NẴNG – SƠN TRÀ\r\n', '\"Đón quý khách tại sân bay Tân Sơn Nhất, đáp chuyến bay khởi hành đi Đà Nẵng (các chuyến bay dự kiến từ 07:00 – 09:30). Đến Đà Nẵng, xe và HDV đón khách.\r\n\r\nĂn trưa đặc sản Đà Nẵng “Bánh tráng thịt heo 2 đầu da & mì Quảng”. Nhận phòng, nghỉ ngơi.\r\n\r\nBuổi chiều, khởi hành tham quan bán đảo Sơn Trà ngắm phố biển từ trên cao.\r\n\r\nViếng Linh Ứng Tự – nơi có tượng Phật Bà cao 67 mét cao nhất Việt Nam.\r\nCông viên kỳ quan thế giới Đà Nẵng – công trình thu nhỏ mô phỏng 9 kỳ quan thế giới và các địa danh nổi tiếng tại Việt Nam.\r\nTắm biển Mỹ Khê – từng được tạp chí Forbes bình chọn là bãi biển quyến rũ nhất hành tinh.\r\nĂn tối. Tự do thưởng ngoạn du thuyền sông Hàn ngắm cảnh Đà Thành về đêm. (chi phí tự túc)\"\r\n'),
(8, 8, 'ĐÀ NẴNG – CÙ LAO CHÀM – HỘI AN\r\n', '\"Ăn sáng buffet tại khách sạn. Di chuyển vào Hội An, đến biển Cửa Đại, ngồi tàu cao tốc khởi hành đi Cù Lao Chàm – khu dự trữ sinh quyển thế giới.\r\n\r\nTrải nghiệm cano cao tốc lướt trên biển xanh, cano cập cảng Bãi Làng Cù Lao.\r\nKhu trưng bày nền văn hóa Sa Huỳnh, khu bảo tồn biển Cù Lao Chàm, chùa Hải Tạng cổ, chợ hải sản Tân Hiệp…\r\nTham gia các hoạt động lặn biển (Snorkeling) ngắm san hô.\r\nĂn trưa tại Cù Lao Chàm. Cano đưa khách trở về đất liền. Tham quan:\r\n\r\nPhố cổ Hội An – du khách tản bộ khám phá các công trình kiến trúc nổi tiếng: Chùa Cầu Nhật Bản, các ngôi nhà cổ hàng trăm tuổi, Hội Quán Phước Kiến, Xưởng thủ công mỹ nghệ. Phố cổ Hội An là quá khứ vàng son của một thương cảng sầm uất thời phong kiến.\r\nĂn tối. Khởi hành về lại Đà Nẵng. Tự do khám phá Đà Nẵng về đêm. Nghỉ đêm tại Đà Nẵng.\"\r\n'),
(9, 8, 'ĐÀ NẴNG – BÀ NÀ – TP. HCM\r\n', '\"Ăn sáng buffet tại khách sạn. Trả phòng. Khởi hành tham quan:\r\n\r\nKhu du lịch Bà Nà Hills – chinh phục Bà Nà bằng hệ thống cáp treo một dây dài nhất thế giới 5.801m và là một trong 10 tuyến cáp treo ấn tượng nhất thế giới. Bà Nà là nơi có những khoảnh khoắc giao mùa bất ngờ Xuân – Hạ – Thu – Đông trong một ngày.\r\n(chi phí cáp treo Bà Nà tự túc).\r\n\r\nChùa Linh Ứng với tượng Phật Thích Ca cao 27m, đền thờ Bà Chúa Mẫu Thượng Ngàn.\r\nCầu Vàng – cây cầu độc đáo nằm trong vườn Thiên Thai, được xây dựng trên độ cao 1.400m so với mặt nước biển, được nâng đỡ bởi kiến trúc hình đôi bàn tay khổng lồ độc đáo.\r\nVui chơi tại Công viên Fantasy Park với hơn 100 trò chơi phiêu lưu hấp dẫn, mang đến cho quý khách nhiều cung bậc cảm xúc bất ngờ và thú vị.\r\nĂn trưa buffet tại Bà Nà (chi phí tự túc). Tiếp tục vui chơi tại Bà Nà Hills.\r\n\r\n*Giá combo vé cáp treo Bà Nà Hills + vé buffet trưa tham khảo: 1,250,000VNĐ/ người.\r\n\r\n(Nếu quý khách không tham quan Bà Nà thì tự túc ăn trưa và tự túc chi phí nhập đoàn tại điểm hẹn).\r\n\r\nDi chuyển ra sân bay Đà Nẵng đáp chuyến bay về lại TP. HCM. (các chuyến bay dự kiến sau 19:00). \r\n\r\nChia tay đoàn và hẹn gặp lại. Kết thúc chương trình tham quan.\r\n\r\nCác mốc thời gian có giá trị tham khảo, tùy theo điều kiện thực tế mà lịch trình có thể thay đổi cho phù hợp.\"\r\n'),
(10, 9, 'TP. HỒ CHÍ MINH – HÀ NỘI\r\n', '\"Tập trung tại sân bay Tân Sơn Nhất đáp chuyến bay TP. HCM – HÀ NỘI. (Các chuyến bay dự kiến từ 06:00 – 09:00). Xe và HDV đón khách tại sân bay Nội Bài, đoàn di chuyển về trung tâm Hà Nội.\r\n\r\nĂn trưa. Nhận phòng khách sạn. Khởi hành tham quan:\r\n\r\nHồ Tây – Hồ lớn nhất Hà Nội, chùa Trấn Quốc, Hồ Gươm, đền Ngọc Sơn, cầu Thê Húc, chụp hình lưu niệm tại Nhà Thờ Lớn, Nhà Hát Lớn Thành phố.\r\nThưởng thức bánh cốm Hàng Than, kem Tràng Tiền – Nét văn hóa ẩm thực đặc trưng rất riêng của Hà Nội.\r\nĂn tối với buffet. Tự do khám phá Hà Nội về đêm. Nghỉ đêm tại Hà Nội.\"\r\n'),
(11, 9, 'HÀ NỘI – TRÀNG AN – BÁI ĐÍNH – HẠ LONG\r\n', '\"Ăn sáng. Làm thủ tục trả phòng. Khởi hành tham quan: \r\n\r\nKhu du lịch Tràng An – Ninh Bình đã được UNESCO công nhận là Di sản Văn hóa và Thiên nhiên Thế giới vào năm 2014. Quý khách ngồi trên thuyền du ngoạn khám phá vẻ đẹp hoang sơ được ví như “Vịnh Hạ Long trên cạn” với vô vàn các hạng động, hệ thống sông, suối chảy tràn trong các thung lũng, các hang xuyên thủy động, các dãy núi đá vôi trùng điệp.\r\nĂn trưa với đặc sản cơm cháy Dê Núi.\r\n\r\nTham quan Chùa Bái Đính, ngôi chùa lớn nổi tiếng miền Bắc, làm lễ cầu phúc lành. Rời Ninh Bình, theo quốc lộ 10 đi Hạ Long ngang qua các tỉnh Nam Định, Thái Bình, Hải Phòng.\r\nRời Ninh Bình, theo quốc lộ 10 đi Hạ Long. Trên đường đi quý khách sẽ được cảm nhận cuộc sống, phong cảnh đặc trưng của đồng bằng Bắc Bộ với cảnh làng quê thanh bình qua các tỉnh Nam Định, Thái Bình, Hải Phòng.\r\n\r\nĂn tối tại Hạ Long. Tự do khám phá chợ đêm Hạ Long. Nghỉ đêm tại Hạ Long.\"\r\n'),
(12, 9, 'HẠ LONG – YÊN TỬ - HÀ NỘI\r\n', '\"Ăn sáng. Trả phòng khách sạn. Khởi hành tham quan:\r\n\r\nVịnh Hạ Long – Di sản thiên nhiên Thế giới được UNESCO công nhận. Chiêm ngưỡng vẻ đẹp huyền bí của hàng ngàn đảo đá và các hang động kỳ thú. Tham quan động Thiên Cung, ngắm cảnh Làng Chài, hòn Ấm, hòn Rùa, hòn Đỉnh Hương, hòn Chó Đá, hòn Gà Chọi,…\r\nĂn trưa. Chiều tham quan: \r\n\r\nKhu danh thắng đất Phật Yên Tử – đất tổ của Thiền Phái Trúc Lâm. Quý khách đi cáp treo, tham quan Vườn Tháp Tổ, Chùa Hoa Yên (đã bao gồm vé cáp treo Yên Tử chặng Hoa Yên).\r\nSau đó khởi hành về Hà Nội, trên đường dừng chân thưởng thức đặc sản bánh đậu xanh Hải Dương.\r\n\r\nDi chuyển về Hà Nội, trên đường dừng chân thưởng thức đặc sản bánh đậu xanh Hải Dương.\r\n\r\nĂn tối với đặc sản bún chả Hà Nội. Nhận phòng, nghỉ ngơi.\r\n\r\nTự do tham gia không gian văn hóa Hà Thành, khám phá ẩm thực phố cổ (chi phí tự túc, chợ diễn ra vào tối thứ 6,7,CN hàng tuần). Nghỉ đêm tại Hà Nội.\"\r\n'),
(13, 9, 'HÀ NỘI – LÀO CAI – SAPA\r\n', '\"Ăn sáng. Trả phòng khách sạn. Khởi hành tham quan:\r\n\r\nVịnh Hạ Long – Di sản thiên nhiên Thế giới được UNESCO công nhận. Chiêm ngưỡng vẻ đẹp huyền bí của hàng ngàn đảo đá và các hang động kỳ thú. Tham quan động Thiên Cung, ngắm cảnh Làng Chài, hòn Ấm, hòn Rùa, hòn Đỉnh Hương, hòn Chó Đá, hòn Gà Chọi,…\r\nĂn trưa. Chiều tham quan: \r\n\r\nKhu danh thắng đất Phật Yên Tử – đất tổ của Thiền Phái Trúc Lâm. Quý khách đi cáp treo, tham quan Vườn Tháp Tổ, Chùa Hoa Yên (đã bao gồm vé cáp treo Yên Tử chặng Hoa Yên).\r\nSau đó khởi hành về Hà Nội, trên đường dừng chân thưởng thức đặc sản bánh đậu xanh Hải Dương.\r\n\r\nDi chuyển về Hà Nội, trên đường dừng chân thưởng thức đặc sản bánh đậu xanh Hải Dương.\r\n\r\nĂn tối với đặc sản bún chả Hà Nội. Nhận phòng, nghỉ ngơi.\r\n\r\nTự do tham gia không gian văn hóa Hà Thành, khám phá ẩm thực phố cổ (chi phí tự túc, chợ diễn ra vào tối thứ 6,7,CN hàng tuần). Nghỉ đêm tại Hà Nội.\"\r\n'),
(14, 10, 'TP. HỒ CHÍ MINH – SEOUL - ĐẢO NAMI – THÁP N’SEOUL\r\n', '\"ĐÊM 1: TP. HỒ CHÍ MINH – SEOUL\r\n\r\nQuý khách tập trung tại sân bay Tân Sơn Nhất. Trưởng đoàn làm thủ tục cho đoàn đáp chuyến bay VJ864 (22:15 – 05:25+1) đi Incheon.\r\n\r\nNghỉ đêm trên máy bay.\r\n\r\nNGÀY 1: ĐẢO NAMI – THÁP N’SEOUL\r\n\r\nĐoàn đến sân bay Quốc tế Incheon, làm các thủ tục nhập cảnh Hàn Quốc.\r\n\r\nSau đó khởi hành đi tham quan.\r\n\r\nĂn sáng. Đoàn di chuyển ra đảo Nami:\r\n\r\nĐảo Nami – nổi tiếng với những tán lá phong, cùng hàng ngân hạnh thẳng tắp đã từng xuất hiện trong bộ phim “Bản tình ca mùa Đông”.\r\n\r\nĂn trưa (Gà Nướng). Sau đó tham quan:\r\n\r\nTháp N’ Seoul – tọa lạc trên núi Namsan, một biểu tượng của thủ đô Seoul, nơi các đôi tình nhân gắn những ổ khóa để thề non hẹn biển với nhau. Tại đây, Đoàn có thể ngắm nhìn toàn cảnh của thành phố (Không bao gồm phí thang máy lên tháp).\r\n\r\nĂn tối (Lẩu Nấm).\r\n\r\nNhận phòng khách sạn – nghỉ đêm ở Seoul.\"\r\n'),
(15, 10, 'EVERLAND\r\n', '\"Ăn sáng ở khách sạn. Xe đưa Đoàn tham quan mua sắm tại:\r\n\r\nCửa hàng tinh dầu thông đỏ – hiểu bài thuốc do Thần y Herjun.\r\nTham gia lớp học làm kim chi, chụp hình với trang phục Hanbok truyền thống của người dân xứ Hàn.\r\nĂn trưa với món (Cơm Truyền Thống). Xe và HDV đưa đoàn tham quan:\r\n\r\nCông viên Everland – nổi tiếng với nhiều trò chơi & các màn trình diễn hấp dẫn. Một trong mười công viên lớn nhất thế giới với nhiều trò chơi cảm giác mạnh, khu vườn thú hoang dã Safari, khu gấu trúc,… thả mình vui chơi trong những vườn hoa sặc sỡ, cùng tham gia diễu hành với đoàn vũ công tại công viên.\r\nĂn tối (Thịt Nướng) tại nhà hàng địa phương.\r\n\r\nHero Show – màn trình diễn phi ngôn ngữ với sự kết hợp giữa hiệu ứng hình ảnh cùng sự pha trộn dí dỏm của hài kịch và hội họa.\r\nXe đưa đoàn về lại khách sạn tự do nghỉ ngơi, khám phá Seoul về đêm. Nghỉ đêm ở Seoul.\"\r\n'),
(16, 10, 'SEOUL – HỒ CHÍ MINH\r\n', '\"Đoàn dùng bữa sáng tại khách sạn và làm thủ tục trả phòng.\r\n\r\nChina Town – khu phố người hoa giữa lòng Hàn Quốc với những kiến trúc, quán ăn, cửa hàng đậm phong cách Trung Quốc mang đến cho quý khách cảm giác yên bình, thú vị.\r\nLàng Bích Họa Songwol-dong Incheon – nổi tiếng với những bức tranh tường sống động và hấp dẫn. Dưới bàn tay tài hoa của những người nghệ sĩ, du khách như được lạc vào thế giới trẻ thơ đầy lý thú. Không gian ngập tràn màu sắc, kích thích thị giác và sự tò mò khi đặt chân tới đây.\r\nĂn trưa (Thịt xào kiểu Hàn). Dừng chân tham quan:\r\n\r\nMua sắm tại Trung tâm bách hóa và đóng kiện hành lý.\r\n\r\nDi chuyển ra sân bay Incheon và ăn nhẹ. Đoàn làm thủ tục về lại TP. Hồ Chí Minh trên chuyến bay VJ861 (21:15 – 0:45+1).\"\r\n'),
(17, 11, 'BANGKOK - PATTAYA\r\n', '\"Ăn sáng, trả phòng khách sạn. Khởi hành đi Pattaya, trên đường dừng chân tham quan:\r\n\r\nLightning Art Museum & Balloon Garden – bảo tàng nghệ thuật ánh sáng & vườn khinh khí cầu nổi tiếng, đây là địa điểm check-in mới của xứ sở chùa vàng Thái Lan.\r\nThưởng thức xôi xoài – đặc sản nổi tiếng Thái Lan\r\nĂn trưa. Tiếp tục hành trình đến Pattaya.\r\n\r\nViếng chùa Phật Lớn – Wat Phra Yai, nằm trên đỉnh của đồi Pratumnak, giữa Pattaya và bãi biển Jomtien, điểm nổi bật của ngôi chùa là bức tượng Phật khổng lồ cao 18 mét uy nghi giữa lối dẫn lên chùa với 108 bậc tam cấp\r\nĂn tối. Tận hưởng massage Thái cổ truyền giúp lưu thông khí huyết, phục hồi sức khỏe.\r\n\r\nNhận phòng và nghỉ đêm tại Pattaya. Tự do khám phá các show biểu diễn nổi tiếng bên Thái (chi phí tự túc).\"\r\n'),
(18, 11, 'BANGKOK - PATTAYA\r\n', '\"Ăn sáng, trả phòng khách sạn. Khởi hành đi Pattaya, trên đường dừng chân tham quan:\r\n\r\nLightning Art Museum & Balloon Garden – bảo tàng nghệ thuật ánh sáng & vườn khinh khí cầu nổi tiếng, đây là địa điểm check-in mới của xứ sở chùa vàng Thái Lan.\r\nThưởng thức xôi xoài – đặc sản nổi tiếng Thái Lan\r\nĂn trưa. Tiếp tục hành trình đến Pattaya.\r\n\r\nViếng chùa Phật Lớn – Wat Phra Yai, nằm trên đỉnh của đồi Pratumnak, giữa Pattaya và bãi biển Jomtien, điểm nổi bật của ngôi chùa là bức tượng Phật khổng lồ cao 18 mét uy nghi giữa lối dẫn lên chùa với 108 bậc tam cấp\r\nĂn tối. Tận hưởng massage Thái cổ truyền giúp lưu thông khí huyết, phục hồi sức khỏe.\r\n\r\nNhận phòng và nghỉ đêm tại Pattaya. Tự do khám phá các show biểu diễn nổi tiếng bên Thái (chi phí tự túc).\"\r\n'),
(19, 11, 'PATTAYA – BANGKOK – BAIYOKE SKY\r\n', '\"Ăn sáng. Trả phòng khách sạn. Khởi hành đến thủ đô Bangkok. Trên đường đi tham quan:\r\n\r\nTrung tâm nghiên cứu giấc ngủ Hoàng gia – Morden Latex: phân viện nghiên cứu các sản phẩm từ cao su hỗ trợ giấc ngủ: gối, nệm…\r\nTrung tâm nghiên cứu rắn độc – xem xiếc rắn và tìm hiểu các sản phẩm chức năng đặc biệt của Hoàng gia chỉ được bán và trưng bày tại đây.\r\nĂn trưa buffet tại tòa nhà 86 tầng Baiyoke Sky – tòa nhà cao nhất Bangkok, thưởng thức ẩm thực thượng hạng và ngắm nhìn toàn cảnh thủ đô Bangkok từ trên cao. Tiếp tục hành trình:\r\n\r\nViếng Chùa Phật Vàng – Wat Traimit: với tượng Phật vàng lớn nhất thế giới; cao 3 mét và nặng hơn 5 tấn. Tượng được đúc theo phong cách Sukhothai tĩnh lặng và được khám phá một cách tình cờ vào thập niên 1950.\r\nTự do khám phá & mua sắm ngay trung tâm Partunam như: MBK, Central World, Big C…\r\nTự do khám phá các món địa phương tại trung tâm Bangkok (Ăn tối tự túc). Nghỉ đêm tại Bangkok.\"\r\n'),
(20, 11, 'BANGKOK – TP. HCM\r\n', '\"Ăn sáng. Trả phòng khách sạn. Di chuyển ra sân bay Suvarnabhumi. Làm thủ tục đáp chuyến bay VN601 BKK SGN (11:20 – 13:10) trở về TP. HCM.\r\n\r\nĐến sân bay Tân Sơn Nhất, làm thủ tục nhập cảnh.  Chia tay đoàn và hẹn gặp lại! \"\r\n'),
(21, 12, 'THÀNH PHỐ HỒ CHÍ MINH - DUBAI\r\n', '\"Tập trung tại ga quốc tế, sân bay Tân Sơn Nhất lúc 20:30, làm thủ tục đáp chuyến bay EK365 SGN – DXB (16:50 – 21:05) của hãng hàng không quốc tế 5* Emirates Airline đến Dubai. Đoàn trải nghiệm dịch vụ đẳng cấp thế giới, nghỉ ngơi và ăn tối trên máy bay.\r\n\r\nĐến sân bay Dubai, làm thủ tục nhập cảnh. Nhận phòng khách sạn 5*. Nghỉ đêm ở Dubai. \"\r\n'),
(22, 12, 'DUBAI CITY TOUR\r\n', '\"Ăn sáng buffet ở nhà hàng. Khởi hành tham quan:\r\n\r\nKhu phố cổ Al Bastakiya – từng là nơi tụ họp sầm uất của các thương nhân vào giai đoạn cuối thế kỷ 19.\r\nDubai Marina – bến du thuyền lớn nhất trên thế giới với toàn bộ chi phí của dự án này lên tới con số kỷ lục 10 tỷ USD.\r\nTrải nghiệm Abra water taxi (Taxi nước) – Du ngoạn dọc theo tuyến đường từ khu vực hành chính ở Deria đến các khu chợ cổ độc đáo ở Dubai.\r\nDừng chân bên nhánh sông Dubai Creek để tham quan chợ vàng Gold Souk và chợ hương liệu Spice Souk.\r\nĂn trưa tại nhà hàng. Tiếp tục hành trình:\r\n\r\nDubai mall – một trong những trung tâm mua sắm lớn nhất thế giới, đủ sức giải cơn khát mua sắm của bất kỳ du khách sành điệu nào.\r\nTháp Burj Khalifa – điểm nhấn thu hút khách du lịch của Dubai, bao gồm khu dân cư, thương mại, khách sạn, vui chơi giải trí, trung tâm mua sắm lớn nhất thế giới.\r\nThưởng thức Water fountain show – là công trình biểu diễn nhạc nước lớn nhất thế giới với sự kết hợp hoàn hảo của âm thanh ánh sáng và nước.\r\nĐến khách sạn làm thủ tục nhận phòng, nghỉ ngơi tại Dubai.\"\r\n'),
(23, 12, 'DUBAI FRAME - PALM JUMEIRAH - SAFARI\r\n', '\"Ăn sáng buffet tại nhà hàng. Khởi hành tham quan:\r\n\r\nĐảo cọ nhân tạo (Palm Jumeirah) – Ngồi tàu điện trên không sẽ giúp quý khách đến đảo cọ nhanh chóng và có cơ hội chiêm ngưỡng vẻ đẹp của hòn đảo nhân tạo từ trên cao.\r\nCheckin với khách sạn 7* nổi tiếng thế giới Burj Al Arab – ngọn tháp của Ả Rập cao 321m. Đây là một trong những khách sạn bậc nhất Thế giới, có hình thuyền buồm Ả Rập, là biểu tượng cho sự đô thị hoá của Dubai. (Chụp hình bên ngoài)\r\nDubai Frame – Công trình kiến trúc độc đáo như một “khung ảnh khổng lồ” nằm gần công viên Zabeel. Tòa nhà này bao gồm hai tòa tháp cao 150 mét được nối với nhau bằng sàn kính cao tới 93 mét.\r\nXem show diễn thời trang của các mặt hàng đồ da lưu niệm.\r\nĂn trưa tại nhà hàng. Di chuyển về khách sạn tự do nghỉ ngơi.\r\n\r\nBuổi chiều, chinh phục sa mạc bằng xe vượt địa hình chuyên dụng. Đến điểm dừng chân, hóa thân thành “người Du mục” qua các trải nghiệm:\r\n\r\nCưỡi lạc đà, trượt cát dạo trên sa mạc chinh phục những đoạn dốc ngắn và trải nghiệm cái nóng oi bức của sa mạc rộng lớn.\r\nĐến điểm cắm trại Lạc đà – một địa điểm tập kết của người dân địa phương để đón các đoàn khách du lịch. Chính nơi đây Quý khách sẽ tận hưởng cảm giác tuyệt vời khi chiêm ngưỡng hoàng hôn sa mạc như một dân du mục thực thụ.\r\nTrải nghiệm vẽ Heina, hút thử sheesha,…và đặc biệt là một bữa tiệc buffet BBQ cùng với các vũ công belly dance cực kỳ quyến rũ.\r\nXe đưa đoàn về khách sạn nghỉ ngơi. Tự do khám phá về đêm.\"\r\n'),
(24, 12, 'DUBAI – ABU DHABI - DUBAI\r\n', '\"Ăn sáng buffet tại nhà hàng. Khởi hành tham quan:\r\n\r\nThánh đường hồi giáo Sheikh Zayed – thánh đường xa hoa nhất thế giới, niềm tự hào của Các Tiểu vương quốc Ả Rập Thống nhất với lối kiến trúc đặc biệt kết hợp các vật liệu xa xỉ.\r\nCon đường ven biển Corniche – con đường đắp dọc bờ biển, dài 8 km bãi biển dài được cắt tỉa cẩn thận, Ngắm nhìn tòa lâu đài nguy nga và sang trọng Presidential Palace và Emirates Palace. Quý khách có cơ hội thưởng thức bánh phủ vàng khi mua vé vào tham quan Emirates Palace (Chi phí tự túc)\r\n \r\n\r\nĂn trưa buffet tại khách sạn 5* quốc tế. Tự do nghỉ ngơi, tiếp tục hành trình khám phá\r\n\r\nBảo tàng Tương Lai – công trình mang kiến trúc lạ mắt, độc đáo của Dubai.\r\nĐoàn khởi hành về Dubai ăn tối tại nhà hàng. Nghỉ ngơi tại khách sạn 5*.\r\n\r\nTự do khám phá về đêm.\"\r\n'),
(25, 12, 'DUBAI – THÀNH PHỐ HỒ CHÍ MINH\r\n', '\"Ăn sáng buffet tại nhà hàng. Trả phòng khách sạn.\r\n\r\nDi chuyển ra sân bay Dubai, làm thủ tục lên chuyến bay EK392 DXB-SGN (09:35 – 20:00) về lại Thành phố Hồ Chí Minh. Đoàn nghỉ ngơi, ăn nhẹ và trải nghiệm dịch vụ 5* trên máy bay.\r\n\r\nĐáp xuống Sân bay Tân Sơn nhất, chia tay đoàn và hẹn gặp lại.\"\r\n'),
(26, 13, 'TP.HCM – THƯỢNG HẢI\r\n', '\"Trưởng đoàn đón Quý khách tại sân bay Tân Sơn Nhất để làm thủ tục checkin đáp chuyến bay CZ6078 SGN-PVG (12:55 – 18:05) đi Thượng Hải. Đến Thượng Hải làm thủ tục nhập cảnh sau đó trở về khách sạn nghỉ ngơi.\r\n\r\nNghỉ đêm tại Thượng Hải.\"\r\n'),
(27, 13, 'THƯỢNG HẢI\r\n', '\"Ăn sáng tại khách sạn, trả phòng. Đoàn đi tham quan:\r\n\r\nĐồng Nhân Đường – tiệm thuốc Đông Y có văn hoá năm nghìn năm của Trung Quốc.\r\nBến Thượng Hải – Nằm bên dòng Hoàng Phố êm đềm, Thượng Hải mang vẻ đẹp nửa hiện đại nửa cổ kính của những công trình kiến trúc. Đến với thành phố Thượng Hải sầm uất người ta không thể không nhắc đến Bến Thượng Hải bởi sức hấp dẫn của nó đối với mỗi du khách\r\nkhi có dịp đặt chân đến.\r\nTháp truyền hình Minh Châu Phương Đông (không lên tháp) – một tháp truyền hình cao nhất Châu Á và đứng thứ ba trên thế giới.\r\nĂn trưa đoàn di chuyển đi Hàng Châu\r\n\r\nChùa Phật Ngọc – tự viện phật giáo nổi tiếng của Trung Quốc – Nằm trên đường Giang Ninh phía Tây thành phố Thượng Hải, chùa Phật Ngọc là một trong những tự viện Phật giáo nổi tiếng của Trung Quốc nói riêng và Châu Á nói chung.\r\nMiếu Thành Hoàng – là một ngôi miếu Thành Hoàng tại Phố cổ Thượng Hải, Trung Quốc. Ngôi miếu là nơi thờ cúng ba nhân vật trong lịch sử Trung Hoa được tôn là Thành hoàng của Thượng Hãi. Tên gọi “Thành hoàng Miếu” cũng được dùng để chỉ khu vực thương mại xung quanh ngôi miếu.\r\nĂn tối tự túc và tự do khám phá Thượng Hải về đêm.\"\r\n'),
(28, 13, 'VÔ TÍCH – Ô TRẤN – HÀNG CHÂU\r\n', '\"Ăn sáng, sau đó di chuyển tham quan:\r\n\r\nXưởng ngọc\r\nÔ Trấn – những công trình nhuốm màu thời gian, mang theo vẻ cổ kính đẹp đến mê lòng khách thập phương. Ô Trấn đã có đến 1300 tuổi đời, gắn với nhiều biến động lịch sử, văn hóa Trung Quốc và tự hào khi được UNESCO công nhận là di sản văn hóa thế giới.\r\nVịnh Caishen – Vịnh Caishen nổi tiếng với cảnh quan đẹp như tranh vẽ, với những ngọn đồi xanh tươi, mặt nước yên tĩnh và cây cối phong phú. Đây là một địa điểm lý tưởng để thư giãn và tận hưởng không khí trong lành của thiên nhiên. Đến đây để dạo chơi, chụp ảnh và thưởng thức vẻ đẹp thiên nhiên, đặc biệt là vào mùa xuân và mùa thu khi cảnh quan thay đổi màu sắc.\r\nNhà Trăm Giường – chuyên sưu tầm và trưng bày những chiếc giường cổ Giang Nam lúc bấy giờ. Hiện nơi đây được ví như một kho tàng với những bộ sưu tập khủng nhiều chiếc giường cổ tiêu biểu từ các triều đại trước.\r\nĂn trưa, đoàn di chuyển đi Tô Châu\r\n\r\nHàn Sơn Tự – ngôi chùa cổ nằm tại phía Tây của trấn Phong Kiều.\r\nPhố cổ ngàn năm Thất Lý Sơn Đường – được mệnh danh là “con phố số 1 ở Cô Tô” và là điểm thu hút khách du lịch nổi tiếng ở Tô Châu, đây là phố đi bộ có lịch sử gần 1200 năm với tổng chiều dài là 3829,6m. Dọc theo con phố là các cửa hàng nhỏ, nhà hàng và nhà ở, điểm chung là đều được xây dựng ven sông, thỉnh thoảng sẽ thấy rất nhiều tàu du lịch chở khách du lịch ra vào trên sông. Đó là một khung cảnh độc đáo ở vùng sông nước Giang Nam.\r\nĂn tối và nghỉ đêm tại Vô Tích.\"\r\n'),
(29, 13, 'VÔ TÍCH – HÀNG CHÂU\r\n', '\"Ăn sáng, đoàn khởi hành tham quan:\r\n\r\nCăn cứ phim ảnh Tam Quốc Thành\r\nNgồi tàu chiếu cổ xưa ngắm khu phong cảnh Thái Hồ (Chi phí tự túc)\r\nTiệm Ngọc trai\r\nDi sản văn hóa thế giới Grand Canal (Đại Vận Hà) – của Trung Quốc, là con kênh nhân tạo dài nhất và lâu đời nhất trên thế giới, uốn mình qua bốn tỉnh, nó bắt đầu ở Bắc Kinh ở phía bắc và kết thúc ở Hàng Châu ở phía nam, và từng là một huyết mạch giao thông quan trọng ở Trung Quốc cổ đại. Khoảng 1/8 con kênh chạy qua Thương Châu, cách Bắc Kinh 180 km. Một đoạn kênh dài hơn 1.000 km đã được công nhận là di sản thế giới vào năm 2014.\r\nĂn trưa. Sau đó khởi hành đi tham quan:\r\n\r\nThưởng thức Trà Long Tỉnh – Top 10 loại trà đứng đầu của Trung Quốc, Hoàng Đế Mãn Thanh Càn Long đã đến thăm Hàng Châu, đã thưởng thức và đã sắc phong cho 18 cây trà được trồng trước Long Tỉnh Tự là Hoàng Trà, nằm ở phía tây bắc mà bây giờ là làng Long Tỉnh.\r\nĂn tối và nghỉ đêm tại Hàng Châu. Hoặc tự túc xem show biểu diễn:\r\n\r\nTống Thành – Thiên Cổ Tình – Hàng Châu chính là cái nôi cho hàng loạt show Thiên Cổ Tình. (Chi phí tự túc)\"\r\n'),
(30, 14, 'TP. HỒ CHÍ MINH - HONGKONG\r\n', '\"Đoàn có mặt tại sân bay quốc tế Tân Sơn Nhất làm thủ tục đáp chuyến bay CX766 (11:15 – 15:00) của Hãng Hàng Không 5* Cathay Pacific đi Hong Kong. Đến sân bay quốc tế Chek Lap Kok, làm thủ tục nhập cảnh. Khởi hành đi tham quan:\r\n\r\nCầu Thanh Mã (Tsing Ma) – là cầu treo có nhịp cầu lớn thứ 7 trên thế giới, nằm tại đặc khu hành chính Hong Kong. Đây là một trong những địa điểm du lịch mang tính biểu tượng của Hong Kong.\r\nĂn tối. Về khách sạn nhận phòng, nghỉ ngơi. Nghỉ đêm ở Hong Kong.\r\n\"\r\n'),
(31, 14, 'HONGKONG CITY TOUR\r\n', '\"Ăn sáng tại khách sạn. Sau đó, khởi hành đi tham quan:\r\n\r\nĐỉnh núi Thái Bình (The Peak) – là ngọn núi cao nhất của đảo Hong Kong với độ cao 552m so với mực nước biển, nằm giữa đảo Hong Kong và đảo Cửu Long. The Peak cũng có giá trị đất đắt nhất thế giới với nhiều gia đình giàu có sinh sống ở đây.\r\nVịnh nước cạn (Repulse) – là vịnh biển đẹp nhất Hong Kong nổi bật với bãi cát vàng mềm mại hình lưỡi liềm trải dài cùng với làn nước trong xanh dịu dàng, mát lạnh quanh năm.\r\nViếng Miếu Thần Tài – để cầu an cầu phước cho gia đình.\r\nĂn trưa. Khởi hành đi tham quan:\r\n\r\nTrung Tâm Hội Nghị Triển Lãm – Với bức vách bằng kính trải rộng và mái nhôm 40.000 mét vuông chạm khắc hình ảnh một con chim biển đang vút bay, là một trung tâm nổi tiếng trên toàn thế giới, và là nơi diễn ra lễ bàn giao Hong Kong – thuộc địa cũ của Anh đã được trao trả lại cho Trung Quốc và khu hành chính đặc biệt Hồng Kông được thành lập. \r\nTòa nhà Yik Cheong Building hệ thống 5 tòa nhà kết nối với nhau tại vịnh Quarry.\r\nĐại lộ Ngôi sao – có chiều dài gần nửa km gắn 100 ngôi sao in dấu vân tay, chữ ký của các nhân vật nổi tiếng Hồng Kông.\r\nBảo tàng Cố Cung Hồng Kông – Bảo tàng nghệ thuật Hồng Kông trung tâm nằm ở mũi phía Tây của Khu Văn hóa Tây Cửu Long, nơi có tầm nhìn bao quát ra Cảng Victoria mang tính biểu tượng của Hồng Kông. (chụp hình bên ngoài). \r\nTham quan, mua sắm tại các khu trung tâm mua sắm sầm uất nhất HongKong như: Mong kok, Chợ Quý Bà,…\r\nĂn tối. Về khách sạn nghỉ ngơi. Nghỉ đêm ở Hồng Kông. \"\r\n'),
(32, 14, 'HỒNG KÔNG – FREE DAY\r\n', '\"Ăn sáng. Tự do tham quan mua sắm hoặc lựa chọn tham quan 1 trong 2 option sau: (tự túc chi phí)\r\n\r\nOption 1: (Giá tham khảo: 4.600.000VNĐ/khách)\r\n\r\n• Công viên Disneyland – là một những công viên giải trí lớn nhất ở Hồng Kông với 7 khu vực chủ đề xoay quanh những bộ phim Disney được yêu thích: Main Street, U.S.A, Fantasyland (Vùng Đất Nhiệm Màu), Adventureland (Miền Khám Phá), Tomorrowland (Vùng Đất Tương Lai), Grizzly Gulch, Mystic Point và Toy Story Land (Thế Giới Đồ Chơi).\r\n(Quý khách tự túc các bữa ăn tại công viên)\r\n\r\nOption 2: (Giá tham khảo: 3.200.000VNĐ/khách)\r\n\r\n• Đại Nhĩ Sơn – nơi có bức tượng Phật thích Ca lớn nhất châu Á. Quý khách có dịp ngắm nhìn toàn cảnh đảo Lantau, sân bay Cheklapkok – công trình lấn biển lớn nhất ở Hồng Kông, toàn cảnh khu vực Tsungchung từ trên cao. Tiếp tục tham quan Bảo Tàng Phật với bức tượng Đức Phật Thích Ca lớn nhất Châu Á, lễ Phật cầu phúc lành, ngắm toàn cảnh núi Đại Nhĩ Sơn. Viếng “Hùng Sơn Đại Điện” ăn trưa với các món chay đặc sắc.\r\n\r\nVề khách sạn nghỉ ngơi. Nghỉ đêm ở Hồng Kông.\"\r\n'),
(33, 14, 'HỒNG KÔNG – TP. HỒ CHÍ MINH\r\n', '\"Ăn sáng và làm thủ tục trả phòng. Sau đó khởi hành đi tham quan:\r\n\r\nTầng 100 của toà nhà Sky 100 – ngắm nhìn toàn cảnh Hồng Kông 360 độ từ trên cao.\r\nKhu văn hóa Tây Cửu Long – không gian trung tâm văn hóa nghệ thuật triển lãm.\r\nChùa Wong Tai Sin (Miếu Huỳnh Đại Tiên) – ngôi chùa nổi tiếng linh thiêng của người dân Hồng Kông. Không chỉ ở Hồng Kông mà ngay cả những người ở Trung Quốc đại lục cũng thường xuyên sang đây để cúng bái. Được xây dựng từ năm 1921 theo truyền thuyết là một vị hòa thượng tên là “Wong Tai Sin” đã tu hành chính quả nơi đây và từ đó lấy tên của ông đặt cho ngôi miếu này.\r\nĂn trưa. Xe đưa đoàn ra sân bay làm thủ tục đáp chuyến bay CX799 (16:10 – 18:35) về lại TP.HCM.\r\n\r\nVề đến sân bay Tân Sơn Nhất, làm thủ tục nhập cảnh, nhận lại hành lý. Kết thúc chương trình tour.\"\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tour`
--

CREATE TABLE `tour` (
  `tourId` int(10) NOT NULL,
  `titlle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `priceAdult` double NOT NULL,
  `priceChild` double NOT NULL,
  `destination` varchar(255) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `itinerary` varchar(255) NOT NULL,
  `reviews` varchar(255) DEFAULT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tour`
--

INSERT INTO `tour` (`tourId`, `titlle`, `description`, `images`, `quantity`, `priceAdult`, `priceChild`, `destination`, `availability`, `itinerary`, `reviews`, `startDate`, `endDate`) VALUES
(1, 'ĐÀ NẴNG – HỘI AN – BÀ NÀ – HUẾ – PHONG NHA', 'MIỀN TRUNG 4N3Đ', 'travela\\public\\clients\\assets\\images\\gallery-tours\\mien-trung-4n3d-da-nang-hoi-an-ba-na-hue-1.png\n', 50, 12333333, 12312321, 'Đà Nẵng', 1, '', NULL, '2025-03-05', '2025-03-27'),
(6, 'HÀ NỘI - LÀO CAI - SA PA', 'MIỀN BẮC 4N3Đ', '[]', 52, 5990000, 4195000, 'Hà Nội', 1, '123', NULL, '2025-03-24', '2025-03-25'),
(8, 'ĐÀ NẴNG - CÙ LAO CHÀM -HỘI AN - BÀ NÀ\r\n', 'MIỀN TRUNG 3N2Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\cau-vang-da-nang.png', 40, 3490000, 2620000, 'Đà Nẵng\r\n', 1, '', NULL, '2025-03-22', '2025-03-25'),
(9, 'HÀ NỘI – NINH BÌNH – HẠ LONG – YÊN TỬ – SAPA\r\n', 'MIỀN BẮC 6N5Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\dinh-fansipan-sapa.png', 42, 9590000, 6715000, 'Hà Nội\r\n', 1, '', NULL, '2025-04-26', '2025-04-30'),
(10, 'SEOUL – NAMI – EVERLAND\r\n', 'HÀN QUỐC MÙA HÈ 4N4Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\thap-namsan-tai-thanh-pho-seoul-han-quoc.jpg', 20, 14990000, 13490000, 'Hàn Quốc\r\n', 1, '', NULL, '2025-05-07', '2025-05-10'),
(11, 'BANGKOK – PATTAYA\r\n', 'THÁI LAN LỄ HỘI TÉ NƯỚC 5N4Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\le-hoi-te-nuoc-thai-lan.jpg', 20, 8490000, 7640000, 'Thái Lan\r\n', 1, '', NULL, '2025-04-13', '2025-04-17'),
(12, 'DUBAI\r\n', 'ABU DHABI 5N4Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\dubai-marina.jpg', 15, 28990000, 26990000, 'Dubai\r\n', 1, '', NULL, '2025-04-23', '2025-04-27'),
(13, 'THƯỢNG HẢI – VÔ TÍCH – Ô TRẤN – HÀNG CHÂU\r\n', 'TRUNG QUỐC 5N4Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\du-lich-o-tran-trung-quoc.jpeg', 15, 16990000, 13990000, 'Trung Quốc\r\n', 1, '', NULL, '2025-04-28', '2025-05-02'),
(14, 'XỨ CẢNG THƠM\r\n', 'HỒNG KÔNG 4N3Đ\r\n', 'travela\\public\\clients\\assets\\images\\gallery-tours\\cau-treo-thanh-ma.jpg', 20, 16990000, 14090000, 'Hồng Kông\r\n', 1, '', NULL, '2025-03-27', '2025-03-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `isActive` enum('y','n') NOT NULL DEFAULT 'n' COMMENT 'y: yes\r\nn: no',
  `status` enum('d','b') DEFAULT NULL COMMENT 'd: delete\r\nb: ban',
  `createdDate` date NOT NULL DEFAULT current_timestamp(),
  `updatedDate` date DEFAULT current_timestamp(),
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `email`, `phoneNumber`, `address`, `isActive`, `status`, `createdDate`, `updatedDate`, `isAdmin`) VALUES
(1, 'hanwangho03', '$2y$10$6y5TlNxOy35I6ygGw/QweenzdYXsHFhzFofY6BmoUwbva4CrH9jEO', 'anhthuan06042003@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'n', NULL, '2025-03-15', '2025-03-19', NULL),
(4, 'hanwangho033', '$2y$10$OxomrJXsJ43dV8La0cnlb.dI0IBU97HJadsaKqSMK4AXg/TzXWkTa', 'anhthuan0604200323@gmail.com', '0356651701', 'Thu Duc ,Ho Chi Minh', 'n', 'b', '2025-03-15', '2025-03-23', 0),
(5, 'hanwangho0333', '$2y$10$xpDEq7qyBuMrz9OPvay.HuG/cxlkGiNBL7LD.2RmA/QZhS.yW1yF2', 'anhthuan0604200333@gmail.com', NULL, NULL, 'y', 'd', '2025-03-15', '2025-03-23', 0),
(6, 'anhthuan06042003@gmail.com', '$2y$10$7276dhku7zR/.OUzqnELCeSubD9VmO4rzMKMHAFXoE7muTN9hZHfe', 'anhthuan0604@gmail.com', NULL, NULL, 'n', NULL, '2025-03-20', '2025-03-20', 1),
(7, 'Thuan Anh', '$2y$10$NtjQ7CjxUeG/HH3B.peGUeAIt9aDEqVI3du6Rfr5NR8K.ZF8YSxpy', 'anhthuan060420033@gmail.com', NULL, NULL, 'n', NULL, '2025-03-31', '2025-03-31', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Chỉ mục cho bảng `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `fk_booking_tour` (`tourId`),
  ADD KEY `fk_booking_user` (`userId`);

--
-- Chỉ mục cho bảng `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatId`),
  ADD KEY `fk_chat_user` (`useriId`),
  ADD KEY `fk_chat_admin` (`adminId`);

--
-- Chỉ mục cho bảng `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkoutId`),
  ADD KEY `fk_checkout_booking` (`bookingId`);

--
-- Chỉ mục cho bảng `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyId`),
  ADD KEY `fk_history_user` (`userId`),
  ADD KEY `fk_history_tour` (`tourId`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `fk_image_tour` (`tourId`);

--
-- Chỉ mục cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceId`),
  ADD KEY `fk_invoice_booking` (`bookingId`);

--
-- Chỉ mục cho bảng `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promotionId`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `fk_review_user` (`userId`),
  ADD KEY `fk_review_tour` (`tourId`);

--
-- Chỉ mục cho bảng `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`timeLineId`),
  ADD KEY `fk_timeline_tour` (`tourId`);

--
-- Chỉ mục cho bảng `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`tourId`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `chat`
--
ALTER TABLE `chat`
  MODIFY `chatId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkoutId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `history`
--
ALTER TABLE `history`
  MODIFY `historyId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promotionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `timeline`
--
ALTER TABLE `timeline`
  MODIFY `timeLineId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `tour`
--
ALTER TABLE `tour`
  MODIFY `tourId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking_tour` FOREIGN KEY (`tourId`) REFERENCES `tour` (`tourId`),
  ADD CONSTRAINT `fk_booking_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Các ràng buộc cho bảng `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_admin` FOREIGN KEY (`adminId`) REFERENCES `admin` (`adminid`),
  ADD CONSTRAINT `fk_chat_user` FOREIGN KEY (`useriId`) REFERENCES `user` (`userId`);

--
-- Các ràng buộc cho bảng `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `fk_checkout_booking` FOREIGN KEY (`bookingId`) REFERENCES `booking` (`bookingId`);

--
-- Các ràng buộc cho bảng `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_tour` FOREIGN KEY (`tourId`) REFERENCES `tour` (`tourId`),
  ADD CONSTRAINT `fk_history_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_image_tour` FOREIGN KEY (`tourId`) REFERENCES `tour` (`tourId`);

--
-- Các ràng buộc cho bảng `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_booking` FOREIGN KEY (`bookingId`) REFERENCES `booking` (`bookingId`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_review_tour` FOREIGN KEY (`tourId`) REFERENCES `tour` (`tourId`),
  ADD CONSTRAINT `fk_review_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Các ràng buộc cho bảng `timeline`
--
ALTER TABLE `timeline`
  ADD CONSTRAINT `fk_timeline_tour` FOREIGN KEY (`tourId`) REFERENCES `tour` (`tourId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
