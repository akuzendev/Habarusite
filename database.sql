-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2022 at 01:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_catergories`
--

CREATE TABLE `app_catergories` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_catergories`
--

INSERT INTO `app_catergories` (`id`, `name`, `description`) VALUES
(1, 'Local', 'Get the latest news updates around locally.'),
(2, 'World', 'Read about the news of around the world'),
(3, 'Tech', 'Read about the most recent trends in Technology'),
(4, 'Buisness', 'Read about the Buisness World'),
(5, 'Sports', 'Read about the latest updates of Sports'),
(6, 'Op-Ed', 'Read about our Opinion Pieces'),
(10, 'Politics', 'Read about Politcis');

-- --------------------------------------------------------

--
-- Table structure for table `app_designation`
--

CREATE TABLE `app_designation` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_designation`
--

INSERT INTO `app_designation` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Writer'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `app_gender`
--

CREATE TABLE `app_gender` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_gender`
--

INSERT INTO `app_gender` (`id`, `name`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(255) NOT NULL,
  `breakingnewsid` int(255) NOT NULL,
  `row1cat` int(255) NOT NULL,
  `row2cat` int(255) NOT NULL,
  `row3cat` int(255) NOT NULL,
  `row4cat` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `breakingnewsid`, `row1cat`, `row2cat`, `row3cat`, `row4cat`) VALUES
(1, 14, 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `app_status`
--

CREATE TABLE `app_status` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_status`
--

INSERT INTO `app_status` (`id`, `name`) VALUES
(0, 'Active'),
(1, 'Pending'),
(2, 'ToBeDeleted'),
(3, 'Blocked');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles`
--

CREATE TABLE `tbl_articles` (
  `id` int(255) NOT NULL,
  `istimeline` int(255) NOT NULL,
  `timelineid` int(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `catergory` int(255) NOT NULL,
  `thumbnail` longtext NOT NULL,
  `byuserid` int(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `content` longtext NOT NULL,
  `relcommentid` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `approvedbyuserid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_articles`
--

INSERT INTO `tbl_articles` (`id`, `istimeline`, `timelineid`, `title`, `subtitle`, `catergory`, `thumbnail`, `byuserid`, `timestamp`, `content`, `relcommentid`, `status`, `approvedbyuserid`) VALUES
(8, 1, 5, 'Habarusite release date confirmed', 'After major changes during last weeks presentation, A hotfix was planned', 3, 'https://picsum.photos/id/1/367/267', 9, '2021-12-27 17:11:17', 'The reality is, some of your followers are not ready to buy yet.  They like your feed, they get your style, but they don’t know enough about you to hand over their hard-earned cash.  Your website needs to step in where your social posts can’t reach.  When done correctly, your killer website becomes:  Your best salesperson, working hard even when you’re not A way to help you build authority and trust with your audience A much cheaper option than opening a brick-and-mortar store and just as profitable The ultimate resource for learning more about your brand, mission, and audience Your website also takes the pressure off potential customers who are not in the ready-to-buy zone. You’ll be able to guide these visitors further down your sales funnel on their time.  This makes your chances of converting later way more likely.  So you need a website. Established.  But what happens when you know less than a six-year-old about building websites?  Or you can’t afford to hire someone to create a website for you right now?  I’ll tell you: You’re going to launch your very first website all on your own.  Actually, you’ll have today’s guide to show you exactly how to get this done even if you have zero technical experience with digital, code-y stuff.  I’ll take you on the same journey I’ve used to build tons of websites.  And I’ll be honest with you, not all my websites were shiny gems. But my early mistakes don’t have to be your failures.  By the end of this guide, you’ll have everything you need to go from concept to publishing your first site. And you’ll breeze right through it like a total pro.  Table of Contents  hide  Step 1: Start with the end goal in mind Step 2: Choose an unforgettable URL Step 3: Choose your hosting plan Step 4: Drop a CMS on your website Step 5: Customize the look to fit your brand Step 6: Create goal-driven content & follow these tips Step 7: Add these tools before launching Step 8: Choose a launch date, fine-tune, and publish that bad boy Step 9: Post-launch bliss and what to do next Step 1: Start with the end goal in mind This is going to sound counterintuitive, but you need to go with it.  Start this website project of yours by brainstorming about your end goal right from the beginning.  What do you want your website to actually do?  Do you want it to attract new readers to your ebook? Does it need to display your portfolio so higher paying clients swing your way? Are you looking to set up a lead generator that works while you sleep? Or, are you creating an ecommerce store to sell your products online? Whatever the case, you need to think about your end goal first.  This one step ensures that every component you build and add to your site aligns with getting you closer to your goal.  Skipping this step will cause major headaches, eager beaver.  You’ll end up spending countless extra hours hashing out our next steps because you never created a solid game plan.  So let’s take a look at a few examples of how goals differ between websites.  Looking at New York Times Bestselling author Elizabeth Gilbert’s homepage, we get her website’s focus right away:', 1, 1, 1),
(9, 1, 4, 'C# 10 released', 'the 10th edition of C# takes the internet by suprise', 3, 'https://picsum.photos/id/1/367/267', 9, '2021-12-27 17:13:47', 'lorem ipsum', 2, 1, 1),
(10, 1, 4, 'Country reopens after lockdown', 'Reopening will help ease the burden', 1, 'https://picsum.photos/id/1029/367/267', 9, '2021-12-28 04:18:32', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious', 3, 1, 1),
(11, 0, 0, 'Supply Chain crisis makes shops vacant', 'Slowed Imports have made it difficult for shops', 1, 'https://picsum.photos/id/1047/367/267', 9, '2021-12-28 04:21:08', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.', 4, 1, 1),
(12, 0, 0, 'Gov declares new programs to improve game fishing', 'A new program will help restart game fishing for local communities', 1, 'https://picsum.photos/id/1051/367/267', 9, '2021-12-28 04:24:47', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.', 5, 1, 1),
(13, 0, 0, 'Gov, opens Carbon Beach', 'After Months of rennovation, The carbon beach is now open for the public', 1, 'https://picsum.photos/id/1052/367/267', 9, '2021-12-28 04:52:56', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.', 6, 1, 1),
(14, 0, 0, 'Tsunami Alert issued after Earthquake in Indonesia', 'A major earthquake has experts vary of the possibility of a tsunami', 2, 'https://picsum.photos/id/1055/367/267', 9, '2021-12-28 05:01:58', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 in', 7, 1, 1),
(15, 0, 0, 'Omnicron variant shows milder symptoms', 'Experts find that the Omnicron variant is milder than other variants', 2, 'https://picsum.photos/id/1063/367/267', 9, '2021-12-28 05:03:09', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 in', 7, 1, 1),
(16, 0, 0, 'Weather changing extremely quickly', 'Experts believe that this is a sign of climate change', 2, 'https://picsum.photos/id/1064/367/267', 9, '2021-12-28 05:04:24', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 in', 8, 1, 1),
(17, 1, 4, 'Solar Eclipse to occur on 31st December 2021', 'A total solar eclipse to occur at the end of the December', 2, 'https://picsum.photos/id/1079/367/267', 9, '2021-12-28 05:09:03', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious ', 9, 1, 1),
(18, 0, 0, 'Clay pots found seen in the ocean', 'Is this part of a Shipwreck or a Capsized', 2, 'https://picsum.photos/id/1081/367/267', 9, '2021-12-28 05:12:36', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.Australia recorded another surge in COVID-19 in', 10, 1, 1),
(19, 0, 0, 'SAFF 2021 to be held in Maldives', 'FAM announces that SAFF 2021 is to be held in Maldives', 5, 'https://picsum.photos/id/12/367/267', 9, '2021-12-28 05:23:37', 'Australia recorded another surge in COVID-19 infections on Tuesday as an outbreak of the highly infectious Omicron variant disrupted a staged reopening of the economy, while state leaders argued over domestic border controls.  The three most populous states, New South Wales (NSW), Victoria and Queensland, reported just under 10,000 new cases between them the previous day, putting the country on course to eclipse the previous day&#39;s record total of 10,186 cases.  There were five COVID-19 deaths reported, although the authorities did not specify whether any were related to the Omicron variant.  The country&#39;s five other states and territories, which have also been experiencing flareups of the virus, were yet to report figures.  The Omicron variant, which medical experts say is more transmissable but less virulent than previous strains, began to spread in Australia just as the country got underway with its plan to reopen after nearly two years of stop-start lockdowns.', 11, 1, 1),
(20, 1, 4, 'MIRA releases complete list of Taxes', 'This was done to simplify TAX processing', 4, 'https://picsum.photos/id/15/367/267', 9, '2022-01-03 13:14:59', 'lorem ipsum', 12, 1, 1),
(21, 0, 4, 'New Article', 'This was done to simplify TAX processing', 2, 'https://picsum.photos/id/15/367/267', 9, '2022-01-03 14:46:34', 'lorem ipsum', 15, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL,
  `byuserid` int(255) NOT NULL,
  `onarticleid` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `content`, `timestamp`, `byuserid`, `onarticleid`, `status`) VALUES
(11, 'This article is good', '2022-01-03 10:39:55', 10, 10, 1),
(12, 'Ehrling - Kids on the Run', '2022-01-03 11:01:37', 10, 10, 2),
(13, 'article is meh', '2022-01-03 12:32:04', 11, 10, 1),
(14, 'This is a good article', '2022-01-04 20:50:40', 11, 14, 1),
(15, 'Ey, Click here to get FREE Bitcoins!! ===&gt; http://aornqwnq21knpi12 k1212krn2r3nt.js', '2022-01-04 20:53:45', 10, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reports`
--

CREATE TABLE `tbl_reports` (
  `id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `reportbyuser` int(255) NOT NULL,
  `targetid` int(255) NOT NULL,
  `remarks` longtext NOT NULL,
  `date` datetime NOT NULL,
  `status` int(255) NOT NULL,
  `handledbyuserid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_reports`
--

INSERT INTO `tbl_reports` (`id`, `type`, `reportbyuser`, `targetid`, `remarks`, `date`, `status`, `handledbyuserid`) VALUES
(5, 'article', 10, 10, 'Article is Bad', '2022-01-03 12:25:11', 0, 0),
(6, 'comment', 11, 12, 'False Advertisement', '2022-01-03 12:32:41', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timelines`
--

CREATE TABLE `tbl_timelines` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `thumbnailurl` longtext NOT NULL,
  `createddate` datetime NOT NULL,
  `byuserid` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_timelines`
--

INSERT INTO `tbl_timelines` (`id`, `title`, `subtitle`, `thumbnailurl`, `createddate`, `byuserid`, `status`) VALUES
(4, 'Global Supply Chain Crisis', 'Read about the updates of the largest supply chain crisis of this decade', 'https://picsum.photos/id/1/367/267', '2021-12-28 08:02:00', 1, 1),
(5, 'Covid-19 Crisis', 'Covid 19 pandemic ', 'https://picsum.photos/id/1/367/267', '2022-01-14 18:51:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` int(255) NOT NULL,
  `designation` int(255) NOT NULL,
  `status` int(255) NOT NULL,
  `countrycode` int(255) NOT NULL,
  `phoneno` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pssword` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fname`, `lname`, `username`, `gender`, `designation`, `status`, `countrycode`, `phoneno`, `email`, `pssword`) VALUES
(0, 'default', 'default', 'default', 1, 1, 1, 960, 1234, 'default@gmail.com', '1234'),
(1, 'john', 'doe', 'johntheadmin', 1, 3, 0, 960, 1234567, 'johndoe@gmail.com', '$2y$10$6uyMKnvCRe8Ta7ajLf5E1ebnh/B8Oxq/zQZXV4UYhmEmFT4XBtgGi'),
(9, 'Jane', 'Doe', 'janedoe', 2, 2, 0, 9760, 1234567, 'janedoe@gmail.com', '$2y$10$h1u5cXYnyo/tjBYCJslmL.foYuQitdKzaAxM3qhHdwG/yLepEKmRq'),
(10, 'Devin', 'hudson', 'devin', 1, 1, 0, 111, 123456789, 'devin@gmail.com', '$2y$10$5Q.Rs5waGTRm7.wzbSuicODXzQtrhJ2QvU8TRUvQmjWMWbg0mrZyy'),
(11, 'James', 'May', 'johndoe', 1, 1, 0, 960, 1234567, 'james@gmail.com', '$2y$10$TXJ/xYTFv.eXR3vcCt8LS.psH69PiFFXGUBs5Sq9JJH27IrUAArIa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_catergories`
--
ALTER TABLE `app_catergories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_designation`
--
ALTER TABLE `app_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_gender`
--
ALTER TABLE `app_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_status`
--
ALTER TABLE `app_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_articles`
--
ALTER TABLE `tbl_articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_catergory` (`catergory`),
  ADD KEY `fk_approvedbyuserid` (`byuserid`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_byuserid` (`byuserid`),
  ADD KEY `fk_onarticleid` (`onarticleid`);

--
-- Indexes for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reportbyuser` (`reportbyuser`),
  ADD KEY `fk_handledbyuserid` (`handledbyuserid`);

--
-- Indexes for table `tbl_timelines`
--
ALTER TABLE `tbl_timelines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_byuser` (`byuserid`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gender` (`gender`),
  ADD KEY `fk_designation` (`designation`),
  ADD KEY `fk_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_catergories`
--
ALTER TABLE `app_catergories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `app_designation`
--
ALTER TABLE `app_designation`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_gender`
--
ALTER TABLE `app_gender`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_status`
--
ALTER TABLE `app_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;

--
-- AUTO_INCREMENT for table `tbl_articles`
--
ALTER TABLE `tbl_articles`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_timelines`
--
ALTER TABLE `tbl_timelines`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_articles`
--
ALTER TABLE `tbl_articles`
  ADD CONSTRAINT `fk_approvedbyuserid` FOREIGN KEY (`byuserid`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `fk_catergory` FOREIGN KEY (`catergory`) REFERENCES `app_catergories` (`id`);

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `fk_byuserid` FOREIGN KEY (`byuserid`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `fk_onarticleid` FOREIGN KEY (`onarticleid`) REFERENCES `tbl_articles` (`id`);

--
-- Constraints for table `tbl_reports`
--
ALTER TABLE `tbl_reports`
  ADD CONSTRAINT `fk_handledbyuserid` FOREIGN KEY (`handledbyuserid`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `fk_reportbyuser` FOREIGN KEY (`reportbyuser`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_timelines`
--
ALTER TABLE `tbl_timelines`
  ADD CONSTRAINT `fk_byuser` FOREIGN KEY (`byuserid`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD CONSTRAINT `fk_designation` FOREIGN KEY (`designation`) REFERENCES `app_designation` (`id`),
  ADD CONSTRAINT `fk_gender` FOREIGN KEY (`gender`) REFERENCES `app_gender` (`id`),
  ADD CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `app_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
