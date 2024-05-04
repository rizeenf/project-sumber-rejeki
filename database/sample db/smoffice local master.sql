-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Apr 2024 pada 05.43
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smoffice`
--

--
-- Dumping data untuk tabel `branches`
--

INSERT INTO `branches` (`id`, `code`, `name`, `notes`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JKT', 'Jakarta', 'Cabang Jakarta', 1, 1, NULL, NULL, '2024-03-18 10:28:20', '2024-03-18 10:28:20', NULL),
(2, 'BKS', 'Bekasi', 'Cabang Bekasi', 1, 1, NULL, NULL, '2024-03-18 10:28:33', '2024-03-18 10:28:33', NULL),
(3, 'BGR', 'Bogor', 'Cabang Bogor', 1, 1, NULL, NULL, '2024-03-18 10:28:47', '2024-03-18 10:28:47', NULL),
(4, 'BTS', 'awda', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Dumping data untuk tabel `brand_products`
--

INSERT INTO `brand_products` (`id`, `name`, `category_product_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SEDAP MANTAP', 4, 1, 1, NULL, NULL, '2024-03-18 10:32:39', '2024-03-18 10:32:39', NULL),
(2, 'GRETEL', 4, 1, 1, NULL, NULL, '2024-03-18 10:32:48', '2024-03-18 10:32:48', NULL),
(3, 'DUNIA BOX', 0, 1, 1, NULL, NULL, '2024-03-18 10:32:59', '2024-03-18 10:32:59', NULL);

--
-- Dumping data untuk tabel `category_products`
--

INSERT INTO `category_products` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TAB', 1, 1, NULL, NULL, '2024-03-18 10:30:51', '2024-03-18 10:30:51', NULL),
(2, 'TISSUE', 1, 1, NULL, NULL, '2024-03-18 10:31:51', '2024-03-18 10:31:51', NULL),
(3, 'MIKA', 1, 1, NULL, NULL, '2024-03-18 10:32:00', '2024-03-18 10:32:00', NULL),
(4, 'DUS', 1, 1, NULL, NULL, '2024-03-18 10:32:07', '2024-03-18 10:32:07', NULL),
(5, 'OTHERS', 1, 1, NULL, NULL, '2024-03-18 10:32:15', '2024-03-18 10:32:15', NULL);

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `code`, `name`, `phone`, `photo`, `address`, `LA`, `LO`, `area`, `subarea`, `status_registration`, `type`, `banner`, `branch_id`, `user_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BGR001', 'TOMMY PLASTIK', '0813 4542 6108', 'uploads/customer//BGR001-TOMMY PLASTIK-18-Mar-2024 175405.jpg', 'PS. BABAKAN MADANG BLOK A NO: 2 SENTUL BOGOR', '-6.5639335321721', '106.86324991286', 'DEPOK', 'DEPOK LAMA', 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:54:06', NULL),
(2, 'BGR002', 'FERY PLASTIK', '0895 1305 0580', 'uploads/customer//BGR002-FERY PLASTIK-19-Mar-2024 053545.jpg', 'JL. H. MAWI RT 03/03 GG. M. AL ISLAH KP. JATI PARUNG', '-6.4272866666667', '106.724525', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 22:35:45', NULL),
(3, 'BGR003', 'MY PLASTIK', '0831 4375 6198', 'uploads/customer//BGR003-MY PLASTIK-19-Mar-2024 055623.jpg', 'JL. CIKOPO SELATAN KP. SUKABIRUS ATAS RT 01/03 KEL. SUKAMAHI', '-6.6557750449496', '106.86184477061', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 22:56:23', NULL),
(4, 'BGR004', 'LARAS PLASTIK', '0838 1542 8935', 'uploads/customer//BGR004-LARAS PLASTIK-19-Mar-2024 055959.jpg', 'JL. MA SALMUN BLOK B 15 PS. ANYAR BOGOR', '-6.5898290346182', '106.79192963988', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 22:59:59', NULL),
(5, 'BGR005', 'MURNI PLASTIK', '0813-1251-3322', 'uploads/customer//BGR005-MURNI PLASTIK-19-Mar-2024 113017.jpeg', 'KP. CUKANG GALEUH RT.05/05 KM.14 DESA CIHERANG', '-6.6873609756587', '106.82576201856', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-19 04:30:18', NULL),
(6, 'BGR006', 'MITRA JAYA II', '0812-7396-4830', NULL, 'PS. CISALAK JL. H. UHON DEPOK', '-6.3785585678908', '106.86663988978', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(7, 'BGR007', 'TUNAS MANDIRI', '0857 7833 9066', NULL, 'JL. RAYA CIDAHU PONDOKOSO TONGGOH', '-6.7992460786865', '106.75887577236', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(8, 'BGR008', 'RAMDAN PLASTIK TOKO', '0888 0918 7835', NULL, 'JL. RAYA CIANJUR - SUKABUMI KM.14 PS.GEKBRONG KEC.GEKBRONG KEL.GEKBRONG KAB.CIANJUR (DEKAT TOKO MACI)', '-6.8674697982354', '107.03270349652', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(9, 'BGR009', 'LANI, TOKO', '0812 9087 8763', NULL, 'JL. LAYUNG SARI 1 EMPANG BOGOR SELATAN', '-6.5911326336936', '106.79257772863', 'DEPOK', NULL, 'Y', 'S', 0, 3, NULL, 1, 1, 1, NULL, '2024-03-18 10:37:36', '2024-04-03 07:34:41', NULL),
(10, 'BGR0010', 'CHA CHA BAHAN KUE', '0812 9897 4327', 'uploads/customer//BGR0010-CHA CHA BAHAN KUE-20-Mar-2024 153555.jpg', 'RUKO 8 JL.RAYA PEMDA KARADENAN RT.003 RW.010 NO.1 KEC.CIBINONG KEL.KARADENAN KAB.BOGOR 16913', '-6.5116051781705', '106.8067850545', 'DEPOK', NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-20 08:35:56', NULL),
(11, 'BGR0010', 'TOKO PLASTIK BARU', NULL, 'uploads/customer//BGR0010-TOKO PLASTIK BARU-28-Mar-2024 140109.jpg', NULL, NULL, NULL, NULL, NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-28 07:01:11', NULL),
(12, 'BGR0010', 'TOKO PLASTIK BARU 2', NULL, 'uploads/customer//BGR0010-TOKO PLASTIK BARU 2-28-Mar-2024 140330.jpg', NULL, '-6.1494295', '106.7116815', 'BOGOR', 'CIBINONG', 'N', 'S', 0, 3, NULL, 1, 1, 1, NULL, '2024-03-18 10:37:36', '2024-04-04 09:27:01', NULL),
(13, 'BGR0010', 'TOKO PLASTIK BARU 3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(14, 'BGR0010', 'TOKO PLASTIK BARU 4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(15, 'BGR0010', 'Geoffrey Forbes', '+1 (802) 804-4455', NULL, 'Maiores voluptas off', '52', '43', 'Ab quis ut et quia q', 'Nostrum ipsa dolori', 'N', 'S', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:37:36', '2024-03-18 10:37:36', NULL),
(16, 'BGR0010', 'Martabak Jakarta', '+1 (295) 436-1993', 'uploads/customer//BGR0010-Martabak Jakarta-19-Mar-2024 114435.jpg', 'Deleniti autem commo', '14', '43', 'Est quo aliquid cons', 'Omnis deleniti imped', 'Y', 'O', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:39:19', '2024-03-27 08:17:47', NULL),
(17, 'BGR0010', 'Martabak Bangka', '0813 4542 6108', 'uploads/customer//BGR0010-Martabak Bangka-19-Mar-2024 113814.jpg', 'PS. BABAKAN MADANG BLOK A NO: 2 SENTUL BOGOR', '-6.5639335321721', '106.86324991286', 'DEPOK', 'DEPOK LAMA', 'Y', 'O', 0, 3, NULL, 1, 1, NULL, NULL, '2024-03-18 10:39:19', '2024-03-28 03:30:47', NULL),
(18, 'JKT001', 'TOKO BAHAN KUE - CANTIK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', 'S', 0, 1, NULL, 1, 1, 1, NULL, '2024-03-28 02:57:41', '2024-03-28 02:57:58', NULL),
(20, 'Et aut amet pariatu', 'Ebony Dickson', '+1 (709) 283-3804', NULL, 'Aliquam aut nisi cup', '2', '86', 'Labore pariatur Dol', 'Sint in quia et vel', 'Y', 'O', 1, 1, NULL, 1, 1, NULL, NULL, '2024-04-04 04:35:09', '2024-04-04 04:35:09', NULL),
(21, 'JKT002', 'Eagan Head', '+1 (232) 511-2037', NULL, 'Amet illum accusam', '57', '29', 'Exercitationem quia', 'Ut recusandae Fugit', 'N', 'O', 1, 1, NULL, 1, 1, NULL, NULL, '2024-04-04 04:36:47', '2024-04-04 04:36:47', NULL),
(22, 'JKT003', 'Minerva Craig', '+1 (845) 625-2408', NULL, 'Quia aut sunt dolore', '29', '55', 'Sit nisi iste ut re', 'Vel quia ipsum dolo', 'Y', 'O', 1, 1, NULL, 1, 1, NULL, NULL, '2024-04-04 04:37:03', '2024-04-04 04:37:03', NULL),
(23, 'JKT004', 'Lael Ortiz', '+1 (987) 591-6309', NULL, 'Amet dolor vero ali', '51', '3', 'Aut facere qui qui m', 'Cum quo et enim non', 'N', 'O', 0, 1, NULL, 1, 1, NULL, NULL, '2024-04-04 04:38:41', '2024-04-04 04:38:41', NULL),
(24, 'Offi\"cia consectetur', 'Dora Sawyer', '+1 (194) 265-5862', 'uploads/customer//Offi\'cia consectetur-Dora Sawyer-05-Apr-2024 100459.jpg', 'Omnis repudiandae ei', '61', '38', 'Eos veniam duis qui', 'Consequuntur qui nih', 'Y', 'O', 0, 1, NULL, 1, 1, NULL, NULL, '2024-04-05 03:03:36', '2024-04-05 03:04:59', NULL),
(25, 'Quis et neque volupt', 'Arsenio - Grant', '+1 (316) 871-7376', NULL, 'Rem voluptas totam i', '82', '97', 'Quas nobis quibusdam', 'Iste accusantium qui', 'Y', 'O', 0, 1, NULL, 1, 1, NULL, NULL, '2024-04-05 07:14:36', '2024-04-05 07:14:36', NULL),
(26, 'Ex autem totam dolor', 'Hyacinth\'Burt', '+1 (957) 369-6491', 'uploads/customer//Ex autem totam dolor--05-Apr-2024 141621.jpg', 'Veniam perferendis', '97', '36', 'Deserunt voluptas qu', 'Fugiat quidem a tota', 'N', 'O', 1, 3, NULL, 1, 1, NULL, NULL, '2024-04-05 07:14:58', '2024-04-05 07:16:21', NULL);

--
-- Dumping data untuk tabel `display_products`
--

INSERT INTO `display_products` (`id`, `name`, `durability`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'TUMPUK', 30, 1, 1, NULL, NULL, '2024-03-18 10:30:04', '2024-03-18 10:30:04', NULL),
(2, 'GANTUNG', 60, 1, 1, NULL, NULL, '2024-03-18 10:30:28', '2024-03-18 10:30:28', NULL),
(3, 'DINDING', 90, 1, 1, NULL, NULL, '2024-03-18 10:30:37', '2024-03-18 10:30:37', NULL);

--
-- Dumping data untuk tabel `moduls`
--

INSERT INTO `moduls` (`id`, `name`, `view`, `detail`, `create`, `edit`, `delete`, `export`, `import`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'branch', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(2, 'position', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(3, 'display', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(4, 'category_product', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:43:09', '2024-03-18 10:43:09'),
(5, 'brand_product', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:43:29', '2024-03-18 10:43:29'),
(6, 'sub_brand_product', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(7, 'product', 1, 1, 1, 1, 1, 1, 1, 1, NULL, '2024-03-18 10:44:16', '2024-03-18 10:44:16'),
(8, 'store', 1, 1, 1, 1, 1, 1, 1, 1, NULL, '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(9, 'outlet', 1, 1, 1, 1, 1, 1, 1, 1, NULL, '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(10, 'unproductive_reason', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(11, 'user_account', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(12, 'modul', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(13, 'group_access', 1, 1, 1, 1, 1, 0, 0, 1, NULL, '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(14, 'log_activity', 1, 1, 0, 0, 0, 0, 0, 1, NULL, '2024-03-28 04:04:28', '2024-03-28 04:04:28');

--
-- Dumping data untuk tabel `owners`
--

INSERT INTO `owners` (`id`, `name`, `nik`, `phone`, `address`, `customer_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hiroko Rodriquez', 'Eum mollit ut corpor', '+1 (797) 978-5192', 'Aut quidem sunt vol', 20, 1, 1, NULL, NULL, '2024-04-04 04:35:09', '2024-04-04 04:35:09', NULL),
(2, 'Cairo Wright', 'Explicabo Sunt laud', '+1 (872) 877-8894', 'Eiusmod eos aut dolo', 21, 1, 1, NULL, NULL, '2024-04-04 04:36:47', '2024-04-04 04:36:47', NULL),
(3, 'Melodie Rasmussen', 'Voluptatem mollitia', '+1 (906) 542-6651', 'Alias elit velit re', 22, 1, 1, NULL, NULL, '2024-04-04 04:37:03', '2024-04-04 04:37:03', NULL),
(4, 'Clare Knox', 'Ducimus recusandae', '+1 (547) 868-7682', 'Voluptatem sunt amet', 23, 1, 1, NULL, NULL, '2024-04-04 04:38:41', '2024-04-04 04:38:41', NULL),
(5, 'Keelie Decker', 'Quia molestiae repel', '+1 (655) 121-6415', 'Id aut sint ex quo', 24, 1, 1, NULL, NULL, '2024-04-05 03:03:36', '2024-04-05 03:03:36', NULL),
(6, 'Oscar Buckley', 'Eaque lorem unde qui', '+1 (919) 128-8253', 'Cupiditate est expli', 25, 1, 1, NULL, NULL, '2024-04-05 07:14:36', '2024-04-05 07:14:36', NULL),
(7, 'Alisa Campbell', 'Commodi cupiditate e', '+1 (927) 715-1825', 'Deserunt placeat su', 26, 1, 1, NULL, NULL, '2024-04-05 07:14:58', '2024-04-05 07:14:58', NULL);

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'branch view', 'web', '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(2, 'branch detail', 'web', '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(3, 'branch create', 'web', '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(4, 'branch edit', 'web', '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(5, 'branch delete', 'web', '2024-03-18 10:42:14', '2024-03-18 10:42:14'),
(6, 'position view', 'web', '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(7, 'position detail', 'web', '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(8, 'position create', 'web', '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(9, 'position edit', 'web', '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(10, 'position delete', 'web', '2024-03-18 10:42:29', '2024-03-18 10:42:29'),
(11, 'display view', 'web', '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(12, 'display detail', 'web', '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(13, 'display create', 'web', '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(14, 'display edit', 'web', '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(15, 'display delete', 'web', '2024-03-18 10:42:47', '2024-03-18 10:42:47'),
(16, 'category_product view', 'web', '2024-03-18 10:43:09', '2024-03-18 10:43:09'),
(17, 'category_product detail', 'web', '2024-03-18 10:43:09', '2024-03-18 10:43:09'),
(18, 'category_product create', 'web', '2024-03-18 10:43:09', '2024-03-18 10:43:09'),
(19, 'category_product edit', 'web', '2024-03-18 10:43:09', '2024-03-18 10:43:09'),
(20, 'category_product delete', 'web', '2024-03-18 10:43:10', '2024-03-18 10:43:10'),
(21, 'brand_product view', 'web', '2024-03-18 10:43:29', '2024-03-18 10:43:29'),
(22, 'brand_product detail', 'web', '2024-03-18 10:43:29', '2024-03-18 10:43:29'),
(23, 'brand_product create', 'web', '2024-03-18 10:43:30', '2024-03-18 10:43:30'),
(24, 'brand_product edit', 'web', '2024-03-18 10:43:30', '2024-03-18 10:43:30'),
(25, 'brand_product delete', 'web', '2024-03-18 10:43:30', '2024-03-18 10:43:30'),
(26, 'sub_brand_product view', 'web', '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(27, 'sub_brand_product detail', 'web', '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(28, 'sub_brand_product create', 'web', '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(29, 'sub_brand_product edit', 'web', '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(30, 'sub_brand_product delete', 'web', '2024-03-18 10:43:54', '2024-03-18 10:43:54'),
(31, 'product view', 'web', '2024-03-18 10:44:16', '2024-03-18 10:44:16'),
(32, 'product detail', 'web', '2024-03-18 10:44:16', '2024-03-18 10:44:16'),
(33, 'product create', 'web', '2024-03-18 10:44:16', '2024-03-18 10:44:16'),
(34, 'product edit', 'web', '2024-03-18 10:44:16', '2024-03-18 10:44:16'),
(35, 'product delete', 'web', '2024-03-18 10:44:17', '2024-03-18 10:44:17'),
(36, 'product export', 'web', '2024-03-18 10:44:17', '2024-03-18 10:44:17'),
(37, 'product import', 'web', '2024-03-18 10:44:17', '2024-03-18 10:44:17'),
(38, 'store view', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(39, 'store detail', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(40, 'store create', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(41, 'store edit', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(42, 'store delete', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(43, 'store export', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(44, 'store import', 'web', '2024-03-18 10:44:37', '2024-03-18 10:44:37'),
(45, 'outlet view', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(46, 'outlet detail', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(47, 'outlet create', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(48, 'outlet edit', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(49, 'outlet delete', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(50, 'outlet export', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(51, 'outlet import', 'web', '2024-03-18 10:45:00', '2024-03-18 10:45:00'),
(52, 'unproductive_reason view', 'web', '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(53, 'unproductive_reason detail', 'web', '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(54, 'unproductive_reason create', 'web', '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(55, 'unproductive_reason edit', 'web', '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(56, 'unproductive_reason delete', 'web', '2024-03-18 10:45:22', '2024-03-18 10:45:22'),
(57, 'user_account view', 'web', '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(58, 'user_account detail', 'web', '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(59, 'user_account create', 'web', '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(60, 'user_account edit', 'web', '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(61, 'user_account delete', 'web', '2024-03-18 10:45:42', '2024-03-18 10:45:42'),
(62, 'modul view', 'web', '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(63, 'modul detail', 'web', '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(64, 'modul create', 'web', '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(65, 'modul edit', 'web', '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(66, 'modul delete', 'web', '2024-03-18 10:45:56', '2024-03-18 10:45:56'),
(67, 'group_access view', 'web', '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(68, 'group_access detail', 'web', '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(69, 'group_access create', 'web', '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(70, 'group_access edit', 'web', '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(71, 'group_access delete', 'web', '2024-03-18 10:46:11', '2024-03-18 10:46:11'),
(72, 'log_activity view', 'web', '2024-03-28 04:04:28', '2024-03-28 04:04:28'),
(73, 'log_activity detail', 'web', '2024-03-28 04:04:28', '2024-03-28 04:04:28');

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Developer', 1, 1, NULL, NULL, '2024-03-18 10:29:05', '2024-03-18 10:29:05', NULL),
(2, 'Staff Merchandaiser', 1, 1, NULL, NULL, '2024-03-18 10:29:19', '2024-03-18 10:29:19', NULL),
(3, 'Area Bussiness Developer', 1, 1, NULL, NULL, '2024-03-18 10:29:40', '2024-03-18 10:29:40', NULL);

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `image`, `competitor`, `competitor_name`, `category_product_id`, `brand_product_id`, `sub_brand_product_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PROD180324053439', 'SEDAP MANTAP 13.5x12', 'Dus update revisi 2', NULL, 0, NULL, 4, 1, 1, 1, 1, NULL, NULL, '2024-03-18 10:34:39', '2024-03-18 10:34:39', NULL),
(2, 'PROD180324053439', 'BAKING PAPER 41X40X60 @500 Lbr', 'Isi 500', NULL, 0, NULL, 4, 2, 1, 1, 1, NULL, NULL, '2024-03-18 10:34:39', '2024-03-18 10:34:39', NULL),
(3, 'PROD180324053439', 'BAKING PAPER CHEF PLUS 40 X 60 (10 LBR)', NULL, NULL, 0, NULL, 4, 2, 1, 1, 1, NULL, NULL, '2024-03-18 10:34:39', '2024-03-18 10:34:39', NULL),
(4, 'PROD190324114304', 'DUNIA BOX 12x12', NULL, NULL, 1, 'DUNIA BOX', 4, 0, 0, 1, 1, NULL, NULL, '2024-03-19 04:43:04', '2024-03-19 04:43:04', NULL);

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'developer', 'web', '2024-03-18 10:48:25', '2024-03-18 10:48:25'),
(2, 'area bussiness developer', 'web', '2024-03-25 06:35:27', '2024-03-25 06:35:27');

--
-- Dumping data untuk tabel `sub_brand_products`
--

INSERT INTO `sub_brand_products` (`id`, `name`, `category_product_id`, `brand_product_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GRETEL LUX', 4, 2, 1, 1, NULL, NULL, '2024-03-18 10:33:23', '2024-03-18 10:33:23', NULL);

--
-- Dumping data untuk tabel `unproductive_reasons`
--

INSERT INTO `unproductive_reasons` (`id`, `name`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'sudah tidak transaksi', 'S', 1, NULL, '2024-03-27 02:55:10', '2024-03-27 02:55:10'),
(2, 'tidak ada tempat', 'S', 1, NULL, '2024-03-18 10:39:51', '2024-03-18 10:39:51'),
(3, 'sudah berlangganan', 'O', 1, NULL, '2024-03-18 10:40:05', '2024-03-18 10:40:05'),
(4, 'stok di toko tidak ada', 'O', 1, NULL, '2024-03-18 10:40:17', '2024-03-18 10:40:17'),
(5, 'ikut arahan bos', 'O', 1, NULL, '2024-03-18 10:40:34', '2024-03-18 10:40:34'),
(6, 'harga terlalu mahal', 'O', 1, NULL, '2024-03-18 10:40:44', '2024-03-18 10:40:44'),
(7, 'pakai dus custom', 'O', 1, NULL, '2024-03-20 03:41:09', '2024-03-20 03:41:09'),
(12, 'sudah bangkrut', 'S', 1, NULL, '2024-03-27 03:36:08', '2024-03-27 03:36:08');

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `position_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Developer', 'developer', 'developer@gmail.com', '2024-03-18 10:26:54', '$2y$12$lK4a1ZkCyQ9PuD3KiBYFkuyjxElb/WC5NShbd86tW1Fr0nBZHrZHu', '3Zs5HVqifDydjt1EE3YJoi54YIbgR5kvj72lKBpHkmRaDiCngol0hgcgdeiB', NULL, 1, 1, NULL, 2, NULL, '2024-03-18 10:26:54', '2024-03-25 06:21:24', NULL),
(2, 'Bapak MD', 'bapakmd', 'bapakmd@gmail.com', NULL, '$2y$12$jUhtKnmfvWzlzXahv6UUauPZDDPToTHrQMTEheEpSnRVX9bp3hYaK', NULL, NULL, 3, 1, 1, 1, NULL, '2024-03-18 10:41:27', '2024-03-25 06:36:35', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
