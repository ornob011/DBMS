SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mystore`
--

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(11) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(24) NOT NULL,
  `last_log_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `login` varchar(12) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(40) NOT NULL,
  `id` int(11) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `security` text NOT NULL,
  `securityanswer` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pin` varchar(6) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;



-- --------------------------------------------------------

--
-- Table structure for table `customer_cart`
--

CREATE TABLE IF NOT EXISTS `customer_cart` (
`cartid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_cart`
--

INSERT INTO `customer_cart` (`cartid`, `productid`, `customerid`, `product_name`, `details`, `price`, `quantity`, `date_added`) VALUES
(4, 19, 11, 'Puma Contest Lite Sneakers', 'Puma Shoes at cheap Price', 28.99, 1, '2020-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `details` text NOT NULL,
  `category` varchar(16) NOT NULL,
  `subcategory` varchar(16) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;



CREATE TABLE IF NOT EXISTS `payment` (
  `cid` int(11) NOT NULL,
  `amount` varchar(8) NOT NULL,
  `cardnumber` varchar(30) NOT NULL,
  `txnID` varchar(100) NOT NULL,
  `cvc` varchar(10) NOT NULL,
  `postal` varchar(11) NOT NULL,
  `payment_time` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `details`, `category`, `subcategory`, `date_added`) VALUES
(19, 'Puma Contest Lite Sneakers', 28.99, 'Puma Shoes at cheap Price', 'Clothing', '', '2020-08-03'),
(20, 'Diesel Magnete Boots', 199, 'High quality shoes from Diesel designed for YOU.', 'Clothing', '', '2020-08-03'),
(21, 'Clarks Newton Energy Boat Shoes', 18.65, 'Very Cheap Shoes.', 'Footwear', '', '2020-08-03'),
(22, 'Puma Drifter Road III Flip Flops', 9.99, 'Amazing made for you.', 'Footwear', '', '2020-08-03'),
(24, 'GlobalBrand Men''s Panjabi', 12.75, 'Traditional Wear', 'Clothing', '', '2020-08-03'),
(25, 'Platinum Studio Solid Men''s Waistcoat', 14.99, 'Solid Men''s Waistcoat', 'Clothing', '', '2020-08-03'),
(26, 'Fastrack Sports Analog Watch', 25, 'Analog Watch - For Men', 'Watches', '', '2020-08-03'),
(27, 'Fossil NATE Analog Watch', 25.45, 'Fossil NATE Analog Watch - For Men', 'Watches', '', '2020-08-03'),
(28, 'Martian Notifier Smart Watch', 43.54, 'Martian Notifier Smart Watch from Switzerland', 'Watches', '', '2020-08-03'),
(29, 'Butterflies Perforated Design Hand Bag', 100, 'Butterflies Perforated Design Hand Bag', 'HandBag', '', '2020-08-03'),
(30, 'Butterflies Elegant Hand Bag', 120.99, 'Butterflies Elegant Hand Bag', 'HandBag', '', '2020-08-03'),
(31, 'Butterflies Laser Cut Hand Bag', 58.34, 'Butterflies Laser Cut Designer Hand Bag', 'HandBag', '', '2020-08-03'),
(32, 'Anna Andre Paris Pure Eau de Toilette - 100 ml', 45.99, 'Anna Andre Paris Pure Eau de Toilette - 100 ml', 'Perfumes', '', '2020-08-03'),
(33, 'Elizabeth Arden Beauty Eau de Toilette - 100 ml', 15.54, 'Elizabeth Arden Beauty Eau de Toilette - 100 ml', 'Perfumes', '', '2020-08-03'),
(34, 'Davidoff Cool Water Eau de Toilette', 12.87, 'Davidoff Cool Water Eau de Toilette', 'Perfumes', '', '2020-08-03'),
(35, 'Paco Rabanne Black XS Eau de Toilette', 134, 'Paco Rabanne Black XS Eau de Toilette', 'Perfumes', '', '2020-08-03'),
(36, 'BlueStone The Carysa Gold Diamond, Peridot Ring', 134.99, 'BlueStone The Carysa Gold Diamond, Peridot Ring', 'Jewellery', '', '2020-08-03'),
(37, 'CaratLane Fiore Rose Gold Necklace', 456.67, 'CaratLane Fiore Rose Gold Necklace', 'Jewellery', '', '2020-08-03'),
(38, 'CaratLane La FoisFor Her Gold Diamond Ring', 256.87, 'CaratLane La FoisFor Her Gold Diamond Ring', 'Jewellery', '', '2020-08-03'),
(39, 'Spiky Stylish Wayfarer Sunglasses', 10, 'Spiky Stylish Wayfarer Sunglasses', 'Sunglasses', '', '2020-08-03'),
(40, 'EYELOVEYOU Over-sized Sunglasses', 20, 'EYELOVEYOU Over-sized Sunglasses', 'Sunglasses', '', '2020-08-03'),
(41, 'Angel Glitter Purple Rainbow, Blue Bow Kids Wayfarer Sunglasses', 25, 'Angel Glitter Purple Rainbow, Blue Bow Kids Wayfarer Sunglasses', '', '', '2020-08-03'),
(42, 'What If?: Serious Scientific Answers to Absurd Hypothetical Questions', 5, 'What If?: Serious Scientific Answers to Absurd Hypothetical Questions', 'EBooks', '', '2020-08-03'),
(43, 'The Lost Hero (Heroes of Olympus Book 1)', 16, 'The Lost Hero (Heroes of Olympus Book 1)', 'EBooks', '', '2020-08-03'),
(44, 'The Monk Who Sold His Ferrari', 15, 'The Monk Who Sold His Ferrari: A Fable About Fulfilling Your Dreams & Reaching Your Destiny', 'Clothing', '', '2020-08-03'),
(45, 'The Kill List', 25, 'The Kill List', 'EBooks', '', '2020-08-03'),
(46, 'Divergent', 20.99, 'Divergent', 'DVD', '', '2020-08-03'),
(47, 'Frozen', 40.55, 'Frozen Animation', 'DVD', '', '2020-08-03'),
(48, 'The Sound Of Music', 21.65, 'The Sound Of Music (45th Anniversary Edition)', 'DVD', '', '2020-08-03'),
(49, 'Pokemon Alpha Sapphire', 35.75, 'Pokemon Alpha Sapphire', 'Gaming', '', '2020-08-03'),
(50, 'Ultimate Action Triple Pack', 25.99, 'Ultimate Action Triple Pack (Includes 3 Games)', 'Gaming', '', '2020-08-03'),
(51, 'Total War: Rome II', 9.99, 'Total War: Rome II', 'Gaming', '', '2020-08-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
ALTER TABLE `admin` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`), ADD UNIQUE KEY  (`username`);
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`), ADD UNIQUE KEY `mobile` (`mobile`,`email`), ADD UNIQUE KEY `login` (`login`);

--
-- Indexes for table `customer_cart`
--
ALTER TABLE `customer_cart`
 ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`), ADD UNIQUE KEY `product_name` (`product_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--

ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer_cart`
--

ALTER TABLE `customer_cart`
MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`login`, `password`, `name`, `id`, `mobile`, `security`, `securityanswer`, `email`, `address`, `city`, `state`, `pin`) VALUES 
('ornob', '1234', 'ornob', NULL, '01778747556', 'What is your nick name?', 'ornob', 'ornob@gmail.com', 'Sonar Bangla Road', 'Sylhet', 'Baluchor', '500032'),
('gourab', '12345', 'gourab', NULL, '01723678901', 'What is your pet name?', 'Cat', 'gourab@gmail.com', 'Khulna', 'Khulna', 'Mongla', '500032');


--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `last_log_date`) VALUES
(1, 'admin', 'admin', '2020-08-03');
