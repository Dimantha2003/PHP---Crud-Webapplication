-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Jul 10, 2024 at 06:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `catId` int(10) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`catId`, `catName`) VALUES
(1, 'Video Game'),
(2, 'Gaming Consoles'),
(3, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `nickName` varchar(255) NOT NULL,
  `descript` text NOT NULL,
  `price` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `catName` varchar(255) NOT NULL,
  `isDeleted` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `nickName`, `descript`, `price`, `img`, `stock`, `catName`, `isDeleted`) VALUES
(1, 'Marvel\'s Spider-Man 2 - Arcade Alley', 'Spider-Man 2', 'Experience an original Marvel’s Spider-Man single player story\r\n*Switch between two playable Spider-Men, Peter Parker and Miles Morales, while exploring Marvel’s New York\r\n*Wield Peter Parker’s new symbiote abilities and Miles Morales’ explosive bio-electric venom powers\r\n*Fight a rogues’ gallery of Marvel’s Super Villains – including Kraven the Hunter, Lizard, an original take on Venom and many more!\r\n*Explore the expanded open world of Marvel’s New York, featuring new environments and locations\r\n*Discover a range of new and in-depth accessibility features for players of different abilities\r\n*Feel the true power of Spider-Man in your hands with deeply immersive adaptive triggers and haptic feedback features', 45000, 'images/spiderman2.jpg', 4, 'Video Game', 'no'),
(2, 'Ghost of Tsushima Director’s Cut – PS5', 'Ghost of Tsushima', 'Full game\r\n*Iki Island expansion: New story, mini-games, enemy types and more\r\n*Legends online co-op mode\r\n*Digital mini art book\r\n*Director’s commentary: The creative team sits down with a renowned Japanese historian to look at the world of Ghost of Tsushima and how it compares to the real-life events that inspired it.\r\n*Hero of Tsushima Skin Set: Golden Mask, Sword Kit, Horse, Saddle', 14500, 'images/ghost-of-tsushima.jpg', 4, 'Video Game', 'no'),
(3, 'God of War Ragnarök – PS5', 'God of War Ragnarök', 'A future, unwritten – Atreus seeks knowledge to help him understand the prophecy of “Loki” and establish his role in Ragnarök. Kratos must decide whether he will be chained by the fear of repeating his mistakes or break free of his past to be the father Atreus needs.\r\n*Instruments of war – The Leviathan Axe, Blades of Chaos and Guardian Shield return alongside a host of new abilities for both Kratos and Atreus. Kratos’ deadly Spartan skills will be tested like never before as he battles gods and monsters across Nine Realms to protect his family.\r\n*Explore vast realms – Journey through dangerous and stunning landscapes while facing a wide variety of enemy creatures, monsters and Norse gods as Kratos and Atreus search for answers.', 17000, 'images/kratos-atreus.jpg', 2, 'Video Game', 'no'),
(4, 'Red Dead Redemption 2', 'Red Dead Redemption 2', 'From the creators of Grand Theft Auto V and Red Dead Redemption\r\n*The deepest and most complex world Rockstar Games has ever created\r\n*Covers a huge range of 19th century American landscapes\r\n*Play as Arthur Morgan, lead enforcer in the notorious Van der Linde gang\r\n*Interact with every character in the world with more than just your gun\r\n*Engage in conversation with people you meet. Your actions influence Arthur’s honour\r\n*Horses are a cowboy’s best friend, both transport and personal companion. Bond with your horse as you ride together to unlock new abilities', 9000, 'images/red-dead-redemption-2-ps4.jpg', 5, 'Video Game', 'no'),
(5, 'Uncharted: Legacy of Thieves Collection – PS5', 'Uncharted', 'Seek your fortune and leave your mark on the map in the UNCHARTED: Legacy of Thieves Collection.\r\n*Uncover the thrilling cinematic storytelling and the largest blockbuster action set pieces in the UNCHARTED franchise\r\n*Delivered by award winning developer Naughty Dog, the UNCHARTED: Legacy of Thieves Collection includes the two critically-acclaimed UNCHARTED 4: A Thief’s End and UNCHARTED: The Lost Legacy.\r\n*Each story is filled with laughs, drama, high octane combat, and a sense of wonder – remastered to be even more immersive.\r\n*Live the adventure like never before with the features and incredible speed of the PlayStation 5 console.', 11250, 'images/uncharted-legacy-of-thieves-collection.jpg', 10, 'Video Game', 'no'),
(6, 'The Witcher 3: Wild Hunt Complete Edition – PS5', 'The Witcher 3', 'Trained from early childhood and mutated to gain superhuman skills, strength, and reflexes, witchers are a counterbalance to the monster-infested world in which they live.*Built for endless adventure, the massive open world of The Witcher sets new standards in terms of size, depth, and complexity.*Take on the most important contract of your life: to track down the child of prophecy, the key to saving or destroying this world.', 10000, 'images/witcher-3-complete-edition.jpg', 4, 'Video Game', 'no'),
(7, 'The Last of Us Part I – PS5', 'The Last of Us I', 'Enhanced visuals: Completely rebuilt from the ground up using Naughty Dog’s latest PS5 engine technology to improve every visual detail, The Last of Us experience has been faithfully enhanced with more realistic lighting and atmosphere, more intricate environments and creative reimaginings of familiar spaces.\r\n*Fast loading: Initial loading times are near instant, and seamless after the first instance thanks to the PS5 console’s SSD – so you can pick up where you left off in the story and load specific encounters and chapters more quickly.\r\n*Haptic feedback: DualSense wireless controller haptic feedback support for every weapon elevates combat encounters, and environments are brought to life through DualSense wireless controller haptic sensations of subtle falling rain, the crunch of stepping on snow and more.\r\n*Adaptive triggers: All The Last of Us iconic weapons, including Joel’s revolver and Ellie’s bow, now deliver dynamic DualSense wireless controller trigger resistance and kickback on firing for deeper combat immersion.\r\n*3D Audio: Designed to make use of the PS5 console’s Tempest 3D AudioTech, Naughty Dog’s newly upgraded audio engine delivers richer soundscapes, bigger explosive moments and more visceral gameplay through compatible stereo headphones (analogue or USB) or TV speakers.', 15000, 'images/the-last-of-us-part-1.png', 7, 'Video Game', 'yes'),
(8, 'The Last of Us Part II', 'The Last of Us Part II', 'A Complex & Emotional Story-Experience the escalating moral conflicts created by Ellie’s relentless pursuit of Vengeance. The cycle of violence left in her wake will challenge your notions of right versus wrong, good versus evil, and hero versus villain.\r\n*A Beautiful Yet Dangerous World – Set out on Ellie’s journey, taking her from the peaceful mountains and forests of Jackson to the lush, overgrown ruins of greater Seattle. Encounter new survivor groups, and terrifying evolutions of the infected.\r\n*Tense & Desperate Action-Survival Gameplay – New & evolved gameplay systems deliver upon the life-or-death stakes of Ellie’s journey through the hostile world.', 9000, 'images/the-last-of-us-part-2.jpg', 8, 'Video Game', 'no'),
(9, 'Red Dead Redemption', 'Red Dead Redemption', 'Experience the epic western adventures that defined a generation. When federal agents threaten his family, former outlaw John Marston is forced to hunt down the gang of criminals he once called friends.\r\n*Experience Marston’s journey across the sprawling expanses of the American West and Mexico as he fights to bury his blood-stained past in the critically acclaimed predecessor to the 2018 blockbuster, Red Dead Redemption 2.\r\n*Also included is Undead Nightmare, the iconic horror story that transforms the world of Red Dead Redemption into an apocalyptic fight for survival against a zombie horde.\r\n*Featuring the complete single-player experiences from both games, Red Dead Redemption also includes bonus content from the Game of the Year Edition and more.', 14000, 'images/red-dead-redemption-1-ps4.jpg', 6, 'Video Game', 'no'),
(31, 'Assassins Creed Mirage – PS5', 'Assassins Creed Mirage ', 'Experience a modern take on the iconic features and gameplay that have defined a franchise for 15 years.\r\n*Parkour seamlessly through the city and stealthily take down targets with more visceral assassinations than ever before.\r\n*Explore an incredibly dense and vibrant city whose inhabitants react to your every move, and uncover the secrets of four unique districts.', 14000, 'images/assassins-creed-mirage.jpg', 7, 'Video Game', 'no'),
(32, 'Helldivers 2 – PS5', 'Helldivers 2 – PS5', 'Enlist in the Helldivers and join the fight for freedom across a hostile galaxy in a fast, frantic, and ferocious third-person shooter.*Become a Legend – You will be assembled into squads of up to four Helldivers and assigned strategic missions. Watch each other’s back – friendly fire is an unfortunate certainty of war, but victory without teamwork is impossible.*The Galactic War – Capturing enemy planets, defending against invasions, and completing missions will contribute to our overall effort. This war will be won or lost depending on the actions of everyone involved. We stand together, or we fall apart.', 15500, 'images/helldivers-2-ps5.jpg', 4, 'Video Game', 'no'),
(33, 'Sony PlayStation 5 Slim', 'Sony PlayStation 5 Slim', 'Slim Design – With PS5, players get powerful gaming technology packed inside a sleek and compact console design.*1TB of Storage –  Keep your favorite games ready and waiting for you to jump in and play with 1TB of SSD storage built in.*Ultra-High Speed SSD – Maximize your play sessions with near instant load times for installed PS5® games.*Integrated I/O – The custom integration of the PS5® console’s systems lets creators pull data from the SSD so quickly that they can design games in ways never before possible.', 165000, 'images/playstation5-slim.jpg', 2, 'Gaming Consoles', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(10) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `town` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `tp` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `Lname`, `email`, `pass`, `address`, `town`, `zip`, `tp`, `position`) VALUES
(1, 'Buddhika', 'Ashen', 'ekabashen1@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Bomugammanagedara,Wewagama', 'Kuliyapitiya', '60195', '0787556494', 'admin'),
(2, '50585058', '', 'prabhashwara@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Edandawela-Wewagama', '', '', '0754567890', 'user'),
(3, 'dinelka', '', 'dinelkaprabhashwara@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Katupotha-Kadahapola', '', '', '0787324561', 'user'),
(4, 'Asin Omal', '', 'asin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '', '', 'user'),
(5, 'Chalina', '', 'chalina@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '', '', 'user'),
(6, 'Thanupa', '', 'thanupa@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '', '', '', 'user'),
(7, 'Asanthi', 'kawya', 'asanthi@gmail.com', '7e240de74fb1ed08fa08d38063f6a6a91462a815', '234,Mal Para', 'Nugegoda', '67123', '0787556494', 'user'),
(8, 'kalhara', 'kavindu', 'kalhaaara420@gmail.com', '322cf56dbda205f47dae256178da4fe3118c9a6a', 'bandaragama', 'bandaragama', '31098', '0764193282', 'user'),
(9, 'chathumi', '', 'chathumi@gmail.com', '5386bffea467a0bcc3c90ecfff578c4c7dc884b8', '', '', '', '', 'user'),
(10, 'chathumi', '', 'chathumilelwala@gmail.com', 'cebe1cf23383d7e3f39155adb602d8ecc89b9a22', '', '', '', '', 'user'),
(11, 'pakaya', '', 'pakaya@gmail.com', '8c547566a07798ff94fddd1589cadac65aeb99f4', '', '', '', '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `orderID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `itemId` int(11) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `isConfirmed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`orderID`, `userID`, `nickname`, `itemId`, `price`, `quantity`, `isConfirmed`) VALUES
(1, 1, 'Red Dead Redemption', 9, 14000, 1, 1),
(2, 3, 'Red Dead Redemption', 9, 14000, 1, 1),
(3, 3, 'Ghost of Tsushima', 2, 14500, 1, 1),
(4, 3, 'Red Dead Redemption', 9, 14000, 1, 1),
(5, 3, 'Ghost of Tsushima', 2, 14500, 1, 1),
(6, 1, 'Uncharted', 5, 11250, 1, 1),
(7, 1, 'Red Dead Redemption 2', 4, 9000, 1, 1),
(8, 3, 'Red Dead Redemption 2', 4, 9000, 1, 0),
(9, 3, 'Red Dead Redemption', 9, 14000, 1, 0),
(10, 7, 'Ghost of Tsushima', 2, 14500, 1, 1),
(11, 8, 'Spider-Man 2', 1, 45000, 1, 1),
(12, 10, 'Ghost of Tsushima', 2, 14500, 1, 0),
(13, 10, 'Sony PlayStation 5 Slim', 33, 165000, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`orderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `catId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
