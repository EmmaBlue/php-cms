-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 15, 2019 at 07:13 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_custom_CMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` tinyint(3) UNSIGNED NOT NULL,
  `cat_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids'),
(4, 'Footware'),
(5, 'Gear'),
(6, 'Electronics'),
(7, 'Fan Wear');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` smallint(5) UNSIGNED NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_description` text NOT NULL,
  `product_img` varchar(250) NOT NULL,
  `product_price` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_description`, `product_img`, `product_price`) VALUES
(1, 'Fox Men\'s Clouded Flex fit Hat', 'Just like a Fox helmet is essential on the track, a Fox hat is critical post-ride. Check out the Clouded Flexfit Hat for comfort and sun protection track side.', 'fox-mens-clouded-flexfit-hat.jpg', '29.99 CAD'),
(2, 'Arc\'teryx Men\'s Zeta SL Jacket - Dark Firoza\r\n', 'Summer hiking and trekking involves unpredictable mountain weather. The Zeta SL Jacket is designed specifically as an emergency shell for hiking. It packs up small so it’s ready whenever sudden storms arise. This superlight, packable, emergency waterproof jacket is made from GORE-TEX fabric with Paclite® Plus product technology. The minimalist design and fully articulated patterning gives an exceptional fit and freedom of movement. Featured with a WaterTight™ front zipper and two hand pockets with RS™ sliders. The non-helmet compatible StormHood™ secures with a halo adjuster. The adjustable cuff and hem help seal out the weather.', 'arc-men-rain-jacket.jpg', '169.99 CAD'),
(3, 'The North Face Men\'s Progessor Pants - Asphalt Grey', 'Purpose built for tough hikes, this technical pant features stretch-woven fabrics for mobility with durable ripstop in the seat and knees for maximum durability.', 'northface-mens-progessor-pants.jpg\r\n', '99.00 CAD'),
(4, 'Fox Men\'s Muffler T Shirt - Black/Yellow', 'The ’90s were rad. Bikes were loud, pink was cool, and the music was punk rock. Borrowing colors and graphics from our limited edition Idol Racewear Capsule, the Muffler Basic Tee throws it back to one of the most iconic times in motocross history.', 'fox-mens-muffler-t-shirt.jpg', '39.99 CAD'),
(5, 'Helly Hansen Men\'s Lifa Merino Half Zip', 'HH Lifa Merino is Helly Hansen’s warmest baselayer, perfect for any type of activity in cold weather. A unique 2-in-1 baselayer with 100% Merino wool combined with Lifa® Stay Warm technology in a 2 layer construction.', 'hh-mens-lifa-merino-half-zip.jpg', '99.00 CAD'),
(6, 'Woods Women\'s Lorette Midlayer Full Zip Jacket - Baltic', 'Designed to maximize your mobility while ensuring comfort, the Lorette Women’s Mid Layer offers functionality with none of the bulk. The close-to-skin fit allows the stretch material to move with you without getting in the way. Built with Polartec® Power Stretch® Pro™ to wick away moisture, the Lorette Women’s Mid Layer is well-suited to dynamic and demanding backcountry adventures. With two zipped hand pockets and a stretch woven bonded zipped sleeve pocket, there’s plenty of room to stash any extras you want to keep on hand. A tall collar provides further comfort and protection.\r\n', 'woods-womens-lorette-Mmdlayer.jpg', '59.99 CAD'),
(7, 'Under Armour Women\'s HeatGear Training Tights', 'Compression: Ultra-tight, second-skin fit for a locked-in feel.', 'stance-womens-socks.jpg', '19.00 CAD'),
(8, 'ASICS Women\'s GEL Ziruss Running Shoes - Black', 'The ASICS Women’s GEL Ziruss Running Shoes features revolutionary FlyteFoam® Technology, for optimal comfort and a responsive ride for the neutral runner. A gradient jacquard-mesh upper is strategically tightened or loosened in zones to allow the foot’s natural motion. 3D-printed overlays provide seamless support to the upper.', 'women-running-shoes.jpg', '119.99 CAD'),
(9, 'TYR Women\'s Alliance Spice Aqua Tank', 'Enjoy your favourite aqua fitness class or swim laps each day in comfort with the TYR Women’s Alliance Spice Aqua Tank. Built for comfortable range of motion, it offers tummy control and bra cups for support.', 'womens-alliance-spice-aqua.jpg', '69.00 CAD'),
(10, 'Stance Women\'s Train Palm Crew Socks', 'Training Conditions May Not Always Be A Walk In The Park So We Designed The Palm Crew To Bring Light And Bright Vibes To Your Routine.', 'stance-womens-socks.jpg', '19.00 CAD'),
(11, 'Nike Kids\' Brasilia Backpack', 'The Nike Brasilia Kids\' Printed Backpack is built for secure storage, featuring a large compartment and small-item pockets inside and out. Its durable design includes padded shoulder straps for comfort when you\'re on the go.', 'kid_backpack.jpg', '49.00 CAD'),
(12, 'adidas Kids\' Superstar Foundation Grade School Shoes - White/Black', 'Have your little one looking Old School cool in the adidas Kids\' Superstar Foundation Grade School Casual Shoes - White/Black, a grade school kids\' sized version of the legendary basketball shoe from the 1970s. Full-grain leather uppers provide flexibility and a luxurious fit, while a rubber shell toe limits wear for lasting durability.', 'kid_shoes.jpg', '39.99 CAD'),
(13, 'Spyder Boys\' Leader Insulated Winter Jacket', 'The Spyder Boys\' Leader Insulated Winter Jacket is an incredibly comfortable and warm winter coat great for being active in the freezing cold.\r\n', 'kid_jacket.jpg', '69.49 CAD'),
(14, 'Under Armour Eyes Up 3.0 Kids\' Stretch Fit Cap\r\n', 'A modern look with keep-cool technology is what you get with the Under Armour Eyes Up 3.0 kids stretch fit cap. Constructed with stretch material for an ultra-comfortable fit. The HeatGear® sweatband wicks away sweat to keep you comfortable all day long.', 'kid_hat.jpg', '19.00 CAD'),
(15, 'Under Armour Boys\' Vertical Logo T Shirt', 'The Under Armour Boys’ Vertical Logo T Shirt has Charged Cotton® that has the comfort of cotton, but dries much faster.', 'under-armour-boys-t-shirt.jpg', '29.00 CAD'),
(16, 'Under Armour Men\'s Remix Running Shoes - Black/Steel\r\n', 'The Under Armour Men\'s Remix Running Shoes - Black/Steel features an internal foam padding around ankle collar & tongue for comfort.', 'underarmor_runningshoes.jpeg', '129.69 CAD'),
(17, 'ASICS Men\'s GT 2000 6 Running Shoes - Yellow/Black/White', 'Less weight, enhanced cushioning, and more energy with every step, the GT-2000™ 6 model delivers optimized performance and high-mileage durability. A widened forefoot accommodates bunions and reduces irritation, while the upper incorporates a better heel-fit to keep you locked down plus improved toe-spring for a smoother transition. The DuoMax® support system and heel-to-toe GEL® cushioning offer protective stability that absorbs shock on any surface.', 'asics_running.jpeg', '169.19 CAD'),
(18, 'adidas Men\'s Ace 17.3 PrimeMesh FG Outdoor Soccer Cleats - Green/Black', 'You’ve already won. It’s just going to take 90 minutes for everyone else to find out. Control the game with every touch with ACE 17. These football boots have a PRIMEMESH upper that delivers precise control with zero wear-in time. Designed to dominate on firm ground.', 'adidas_soccer_shoes.jpeg', '99.79 CAD'),
(19, 'Merrell Women\'s Zoe Sojourn Lace E-Mesh Q2 Shoes Black', 'Pack light. Live big. Zoe The Women\'s Merrell Sojourn Lace E-Mesh conforms to the foot while allowing for effortless on and off. Q Form 2™ midsole provides gentle alignment, superior comfort, and endless travel bliss.', 'women_shoes.jpeg', '49.99 CAD\r\n'),
(20, 'Nike Men\'s LeBron 15 Basketball Shoes - Black/Sail/Crimson', 'The Nike Men\'s LeBron 15 Shoe delivers premium innovation that heralds a totally new direction for LeBron James. The shoe features durable Battleknit construction and an advanced cushioning system—both designed expressly for the greatest player in the world.', 'basket_shoes.jpeg', '229.29 CAD'),
(21, 'Bauer Supreme S180 Senior Hockey Skates', 'The Bauer Supreme S180 hockey skates offer a greater range of motion and anatomical fit to create a faster and more powerful stride, maximizing a player’s speed and power on the ice', 'hockey_skate.jpeg\r\n', '399.99 CAD'),
(22, 'Cobra King F8 Black Driver with Aldila NV 2KXV Blue Shaft', 'The KING F8 Driver introduces COBRA\'s first CNC milled driver face paired with 360° Aero™ Technology, bringing you COBRA’s smartest, fastest, most precise driver ever. Oversized shape for maximum forgiveness.', 'golf_club.jpeg', '529.69 CAD'),
(23, 'Manduka Commuter Mat Carrier\r\n', 'Designed to fit mats of any size, the Commuter mat carrier is an eco-friendly alternative that keeps your yoga mat easily accessible and at your side for all occasions.', 'yoga.jpeg', '49.00 CAD'),
(24, 'adidas World Cup 2018 Glider Size 5 Soccer Ball Solar Red/Black', 'Celebrate football\'s ultimate competition with this replica ball. It has a machine-stitched construction for a precise touch and a butyl bladder for great air retention. Inspired by Russia\'s urban landscapes, a pixelated graphic pays tribute to the iconic Telstar ball.', 'adidas_soccerballs.jpeg', '29.99 CAD'),
(25, 'Wilson NCAA Solution Official Game Basketball', 'The Wilson Solution basketball is the official game ball of the NCAA and March Madness. Built with a cushion core which has superior softness and grip making those slick moves on the court much easier. ', 'wilson_basketball.jpeg', '89.99 CAD'),
(76, 'Garmin Forerunner 735XT GPS Running Watch Midnight Blue', 'Be a better athlete today than you were yesterday with Forerunner 735XT. This GPS running watch with multisport features is for athletes who want dialed-in data for training and a lighter load on race day. A smaller form factor and comfortable band make 735XT the ideal watch to get you from workout through workday. Connected features like automatic uploads to Garmin Connect, the free online fitness community, lets you share your stats and triumphs through social media.', 'garmin_forerunner.jpeg', '449.19 CAD'),
(77, 'Fitbit Charge 2 Fitness Tracker - Teal Small', 'Make every beat count with the Fitbit Charge 2 Fitness Tracker, built with PurePulse® heart rate, multi-sport modes, guided breathing sessions & interchangeable bands.', 'fitbit.jpeg', '129.19 CAD'),
(78, 'Garmin vívofit Junior Activity Tracker - Star Wars The Resistance', 'The Force is all around when The Resistance vívofit jr. 2 is on your kid’s wrist. This swim-friendly Garmin activity tracker is tough enough to make it through playtime, and with 1+ year battery life, there’s no stopping the action to recharge. Parents manage chores and rewards from the parent-controlled mobile app, while kids get to experience app adventures that feature Star Wars characters such as BB-8. As tough as a star destroyer, the vívofit jr. 2 features a customizable color screen and comfortable band. Kids can show their Star Wars pride and rock it everywhere from recess to soccer, during bath time and even to bed. The user-replaceable battery will keep kicking for more than a year — no charging necessary.', 'vivofit.jpeg', '99.99 CAD'),
(79, 'Polar M200 GPS Running Watch - Red', 'The best workout is the one you do. The easy-to-use Polar M200 with wrist-based heart rate monitoring motivates and guides you every step of the way.', 'polar_watch.jpeg', '127.99 CAD'),
(80, 'Garmin fenix 5X GPS Watch Sapphire Crystal, Slate Grey with Black Band', 'Combining world-class performance with the best features of a fitness and outdoor watch, fenix 5X is the premiere multisport training companion. You get advanced features such as Elevate wrist heart rate technology, built-in activity profiles, performance metrics and training status readings that show the fitness-enhancing effects of your workout. Smart notifications help you stay in touch on the go. Plus, QuickFit Bands let you tailor the look to any lifestyle or activity – no tools required. Go from workplace to workout without breaking stride.', 'fenix_garmin.jpeg', '849.99 CAD'),
(81, 'Toronto Maple Leafs adidas Parley Authentic 2019 All-Star Black Game Jersey', 'Show off your Toronto pride during the All-Star Game. This hockey jersey is cut for extra room, and it\'s just like the one players wear on the ice during hockey\'s premier showcase event. A big Maple Leafs logo puts your loyalty front and centre. This product is created with yarn made in collaboration with Parley for the Oceans. Some of the yarn features Parley Ocean Plastic™ which is made from recycled waste, intercepted from beaches and coastal communities before it reaches the ocean.\r\n', 'toronto_maple_leaf.jpeg', '219.99 CAD'),
(82, 'NBA 2019 All-Star Toronto Raptors Leonard Swingman Jersey', 'Represent your team at the 2019 NBA All-Star Game with this Leonard Toronto Raptors jersey from Nike. It boasts Raptors graphics and classic trims along with Dri-FIT technology for added comfort. Also featured is NikeConnect technology, which unlocks exclusive content including highlights, special offers and more epic fan experiences on game day.', 'toronto_raptors.jpeg', '150.00 CAD'),
(83, 'Los Angeles Lakers Nike Men\'s LeBron James City Edition Swingman Jersey', 'Techknit, directly inspired by the on court jersey, premium double knit mesh material, heat applied twill graphics, classic construction and trim details, tailored fit, basketball.', 'la_lakers.jpeg', '130.00 CAD'),
(84, 'Toronto FC Men\'s adidas 2018 Replica Home Jersey\r\n', 'When the Reds bang in free kicks on their home field, they do it in a version of this adult replica soccer jersey. Ventilated climacool® keeps you cool and dry, while a team badge shows everyone you root for the high-scoring squad from Toronto.', 'toronto_soccer.jpeg\r\n', '109.99 CAD\r\n'),
(85, 'Team Canada Fan Women\'s Hockey Jersey', 'Be a part of Team Canada and get your Team Canada Fan Women\'s Hockey Jersey.', 'hockey_canada_jersey.jpeg', '130.00 CAD');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prod_cat`
--

CREATE TABLE `tbl_prod_cat` (
  `link_id` tinyint(3) UNSIGNED NOT NULL,
  `product_id` smallint(6) NOT NULL,
  `cat_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_prod_cat`
--

INSERT INTO `tbl_prod_cat` (`link_id`, `product_id`, `cat_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 3),
(12, 12, 3),
(13, 13, 3),
(14, 14, 3),
(15, 15, 3),
(16, 16, 4),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 5),
(22, 22, 5),
(23, 23, 5),
(24, 24, 5),
(25, 25, 5),
(26, 76, 6),
(27, 77, 6),
(28, 78, 6),
(29, 79, 6),
(30, 80, 6),
(31, 81, 7),
(32, 82, 7),
(33, 83, 7),
(34, 84, 7),
(35, 85, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `user_fname` varchar(250) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_pass` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_ip` varchar(50) NOT NULL DEFAULT 'no',
  `user_login_time` datetime DEFAULT NULL,
  `user_failed_login` int(3) DEFAULT '0',
  `user_failed_login_time` datetime DEFAULT NULL,
  `user_active` tinyint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_fname`, `user_name`, `user_pass`, `user_email`, `user_date`, `user_ip`, `user_login_time`, `user_failed_login`, `user_failed_login_time`, `user_active`) VALUES
(24, 'admin', 'admin', '$2y$10$w..4e1K8eFGE3acyPsjgvubeXycxSPvTbzem9RsHcYYunZ8bnJtl6', 'admin@test.com', '2019-04-15 16:29:07', '::1', '2019-04-15 14:35:41', 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_prod_cat`
--
ALTER TABLE `tbl_prod_cat`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_prod_cat`
--
ALTER TABLE `tbl_prod_cat`
  MODIFY `link_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;