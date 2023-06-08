-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 11:42 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talent-connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`) VALUES
(1, 'admin1', 'admin1@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(15, 'admin2', 'admin2@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(16, 'admin3', 'admin3@gmail.com', '21232f297a57a5a743894a0e4a801fc3'),
(19, 'admin4', 'admin4@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `bookmark_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `job_ID` int(11) NOT NULL,
  `internship_ID` int(11) NOT NULL,
  `scholarships_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`bookmark_ID`, `user_ID`, `user_role`, `course_ID`, `job_ID`, `internship_ID`, `scholarships_ID`) VALUES
(5, 1, 'individual', 6, 0, 0, 0),
(9, 1, 'individual', 12, 0, 0, 0),
(13, 1, 'individual', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Programming'),
(2, 'Data Science'),
(3, 'Web Development'),
(4, 'Artificial Intelligence'),
(5, 'Business'),
(6, 'Mobile Development'),
(7, 'Digital Marketing'),
(8, 'UI/UX Design'),
(9, 'Network Security'),
(10, 'Cloud Computing'),
(11, 'Game Development'),
(12, 'E-commerce'),
(13, 'Database Management'),
(14, 'Project Management'),
(15, 'Graphic Design'),
(16, 'Cybersecurity'),
(17, 'Software Engineering'),
(18, 'Data Analytics'),
(19, 'Internet of Things'),
(20, 'Machine Learning'),
(21, 'Finance'),
(22, 'Healthcare'),
(23, 'Human Resources'),
(24, 'Marketing'),
(25, 'Robotics'),
(26, 'Supply Chain Management'),
(27, 'Social Media'),
(28, 'UI/UX Design'),
(29, 'Virtual Reality'),
(30, 'Blockchain'),
(31, 'Big Data'),
(32, 'Product Management'),
(33, 'Quality Assurance'),
(34, 'DevOps'),
(35, 'Bioinformatics'),
(36, 'Geographic Information System'),
(37, 'Quantum Computing'),
(38, 'Natural Language Processing'),
(39, 'Cloud Security'),
(40, 'Data Visualization'),
(41, 'AR/VR Development'),
(42, 'Ethical Hacking'),
(43, 'UI Design'),
(44, 'Game Design'),
(45, 'Video Editing'),
(46, 'Content Writing'),
(47, 'Machine Vision'),
(48, 'Embedded Systems'),
(49, 'IT Support'),
(50, 'Sales'),
(51, 'Public Relations'),
(52, 'Risk Management'),
(53, 'Data Warehousing'),
(54, 'Backend Development'),
(55, 'Frontend Development'),
(56, 'Cloud Architecture'),
(57, 'Art'),
(58, 'Music Production'),
(59, 'Event Management'),
(60, 'Customer Service'),
(61, 'Business Intelligence'),
(62, 'UI Testing'),
(63, 'Database Administration'),
(64, 'Mobile App Testing'),
(65, 'Social Media Marketing'),
(66, 'SEO Optimization'),
(67, 'Product Design'),
(68, 'Network Administration'),
(69, 'Data Mining'),
(70, 'Quality Control'),
(71, 'System Analysis'),
(72, 'Information Security');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(50) NOT NULL,
  `company_Name` varchar(100) NOT NULL,
  `company_Email` varchar(50) NOT NULL,
  `company_Password` varchar(50) NOT NULL,
  `company_PhoneNumber` int(50) NOT NULL,
  `company_Country` varchar(50) NOT NULL,
  `company_City` int(11) NOT NULL,
  `company_Status` varchar(10) NOT NULL,
  `company_Logo` text NOT NULL,
  `company_Website` varchar(255) NOT NULL,
  `company_Location` varchar(255) NOT NULL,
  `company_Linkedin` varchar(255) NOT NULL,
  `company_Twitter` varchar(50) NOT NULL,
  `company_Facebook` varchar(50) NOT NULL,
  `company_Instagram` varchar(50) NOT NULL,
  `company_About` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_Name`, `company_Email`, `company_Password`, `company_PhoneNumber`, `company_Country`, `company_City`, `company_Status`, `company_Logo`, `company_Website`, `company_Location`, `company_Linkedin`, `company_Twitter`, `company_Facebook`, `company_Instagram`, `company_About`) VALUES
(1, 'ABC Corporation', 'abc@example.com', '21232f297a57a5a743894a0e4a801fc3', 123456789, 'Lebanon', 0, 'pending', 'ABC Corporation.jpg', 'https://www.abc.com', 'Saida, Lebanon', 'https://www.linkedin.com/company/abc-corporation', 'https://twitter.com/abccorp', 'https://www.facebook.com/abccorp', 'https://www.instagram.com/abccorp', 'ABC Corporation is a leading technology company based in New York, USA. We specialize in providing innovative solutions for businesses across various industries. With a team of skilled professionals and a customer-centric approach, we strive to deliver cutting-edge products and services that drive growth and success for our clients.\r\n\r\n    At ABC Corporation, we believe in the power of technology to transform businesses. Our diverse portfolio includes software solutions, mobile applications, and customized systems tailored to meet the unique needs of our clients. We leverage the latest technologies and industry best practices to develop robust and scalable solutions that enhance efficiency, streamline operations, and drive profitability.\r\n\r\n    As a customer-focused organization, we prioritize building long-lasting partnerships with our clients. We work closely with them to understand their business goals and challenges, enabling us to provide personalized and tailored solutions that address their specific needs. Our team of experts combines technical expertise with deep industry knowledge to deliver solutions that exceed expectations.\r\n\r\n    In addition to our technical capabilities, we are committed to maintaining the highest standards of professionalism, integrity, and ethical conduct. We believe in fostering a collaborative and inclusive work environment that encourages creativity, innovation, and continuous learning. Our dedication to excellence and customer satisfaction has earned us a reputation as a trusted technology partner.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated with our latest projects, industry insights, and company news. We are excited to embark on this journey of digital transformation with you and help your business thrive in the ever-evolving technological landscape.'),
(2, 'XYZ University', 'xyz@example.com', '21232f297a57a5a743894a0e4a801fc3', 987654321, 'United Kingdom', 0, 'pending', 'vXDg_u20_400x400.jpg', 'https://www.xyz.com', 'XYZ City', 'https://www.linkedin.com/company/xyz-university', 'https://twitter.com/xyz_university', 'https://www.facebook.com/xyzuniversity', 'https://www.instagram.com/xyz_university', 'XYZ University is a prestigious educational institution committed to providing high-quality education and fostering intellectual growth. With a diverse range of academic programs and a dedicated faculty, we aim to empower students with the knowledge and skills necessary for success in their chosen fields.\r\n\r\n    At XYZ University, we prioritize student-centric learning, emphasizing practical application and experiential learning opportunities. Our state-of-the-art facilities, well-equipped laboratories, and extensive library resources create an ideal environment for learning and research.\r\n\r\n    Located in XYZ City, our university has a vibrant campus life that encourages students to engage in extracurricular activities, clubs, and organizations. We believe in holistic development and provide support services to ensure the well-being and academic success of our students.\r\n\r\n    Our esteemed faculty comprises experienced professors and industry professionals who bring their expertise and real-world insights into the classroom. We foster a collaborative learning environment that encourages critical thinking, creativity, and innovation.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated on the latest news, events, and achievements of our university community. We welcome students from all backgrounds to join us in their educational journey and make a positive impact on society.'),
(3, '123 Corporation', '123@example.com', '21232f297a57a5a743894a0e4a801fc3', 456123789, 'United Arab Emirates', 0, 'pending', '123 Corporation.jpeg', 'https://www.123corp.com', 'Some Location', 'https://www.linkedin.com/company/123-corporation', 'https://twitter.com/123corp', 'https://www.facebook.com/123corp', 'https://www.instagram.com/123corp', '123 Corporation is a dynamic and innovative company that specializes in providing cutting-edge solutions for businesses. With a strong focus on customer satisfaction, we strive to deliver exceptional products and services tailored to meet the unique needs of our clients.\r\n\r\n    At 123 Corporation, we believe in leveraging the power of technology to drive business success. Our dedicated team of experts works tirelessly to develop scalable software solutions, mobile applications, and customized systems that empower our clients to streamline operations, increase efficiency, and achieve their goals.\r\n\r\n    We take pride in our commitment to delivering high-quality solutions that exceed expectations. Our company culture fosters creativity, collaboration, and continuous learning, enabling us to stay at the forefront of technological advancements and provide innovative solutions for our clients.\r\n\r\n    With a strong online presence, you can connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated on our latest projects, industry insights, and company news. We look forward to partnering with you and helping your business thrive in the digital age.'),
(4, 'Global Enterprises', 'global@example.com', '21232f297a57a5a743894a0e4a801fc3', 789456123, 'United Kingdom', 0, 'blocked', 'Global Enterprises.jpg', 'https://www.globalent.com', 'Global', 'https://www.linkedin.com/company/global-enterprises', 'https://twitter.com/globalent', 'https://www.facebook.com/globalent', 'https://www.instagram.com/globalent', 'Global Enterprises is a multinational corporation that operates worldwide, providing comprehensive solutions to businesses across various industries. With a strong focus on innovation and excellence, we aim to be a trusted partner for companies seeking to navigate the complexities of the global marketplace.\r\n\r\n    At Global Enterprises, we understand the evolving business landscape and the need for scalable and adaptable solutions. Our team of experts collaborates with clients to identify their specific requirements and develop tailored strategies that drive growth and success. We offer a wide range of services, including consulting, technology solutions, and business process outsourcing, designed to optimize operations and maximize efficiency.\r\n\r\n    Our global presence enables us to leverage our extensive network and diverse expertise to deliver solutions that meet the unique challenges of different markets. We combine deep industry knowledge with cutting-edge technologies to help our clients gain a competitive advantage and achieve sustainable growth.\r\n\r\n    As a socially responsible organization, we are committed to conducting business ethically and fostering a culture of diversity, inclusion, and environmental sustainability. We strive to make a positive impact on the communities we serve and contribute to a better future.\r\n\r\n    Stay connected with us on LinkedIn, Twitter, Facebook, and Instagram to stay informed about our latest initiatives, thought leadership, and company updates. We look forward to partnering with you on your global journey.'),
(5, 'Acme Co', 'acme@example.com', '21232f297a57a5a743894a0e4a801fc3', 321654987, 'Lebanon', 0, 'blocked', 'Acme Co.png', 'https://www.acmeco.com', 'Acme City', 'https://www.linkedin.com/company/acme-co', 'https://twitter.com/acme', 'https://www.facebook.com/acme', 'https://www.instagram.com/acme', 'Acme Co is a leading company that offers a wide range of products and services to customers worldwide. With a commitment to quality and innovation, we strive to deliver exceptional solutions that meet the diverse needs of our clients.\r\n\r\n    At Acme Co, we believe in continuous improvement and customer satisfaction. Our dedicated team of professionals works diligently to develop and deliver top-notch products and services. Whether it is manufacturing, technology, or consulting, we aim to exceed expectations and provide value to our customers.\r\n\r\n    With a strong presence in Acme City and beyond, we have established ourselves as a reliable and trustworthy partner for businesses across various industries. We leverage our expertise and industry insights to drive growth and help our clients achieve their goals.\r\n\r\n    Our company values integrity, collaboration, and sustainability. We are committed to conducting business ethically and responsibly, while also making a positive impact on the environment and communities we operate in.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated on the latest news, events, and offerings from Acme Co. We look forward to serving you and contributing to your success.'),
(6, 'Tech Solutions', 'tech@example.com', '21232f297a57a5a743894a0e4a801fc3', 654789321, 'Lebanon', 0, 'approved', 'Tech Solutions.jpg', 'https://www.techsolutions.com', 'Tech City', 'https://www.linkedin.com/company/tech-solutions', 'https://twitter.com/techsolutions', 'https://www.facebook.com/techsolutions', 'https://www.instagram.com/techsolutions', 'Tech Solutions is a leading technology company that provides innovative solutions to businesses across various industries. With a focus on cutting-edge technologies and customer satisfaction, we aim to empower our clients and help them thrive in the digital era.\r\n\r\n    At Tech Solutions, we believe in the transformative power of technology. Our team of experts combines deep industry knowledge with technical expertise to develop customized software solutions, mobile applications, and IT infrastructure that drive efficiency, productivity, and growth.\r\n\r\n    With a strong presence in Tech City and a global reach, we cater to clients of all sizes, from startups to large enterprises. We understand the unique challenges and opportunities that each business faces, and we work closely with our clients to deliver tailored solutions that address their specific needs.\r\n\r\n    Our company culture values innovation, collaboration, and continuous learning. We invest in our team\'s professional development to stay at the forefront of emerging technologies and industry trends. This ensures that we can provide our clients with the most advanced and effective solutions available.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay informed about our latest projects, industry insights, and company updates. We are excited to partner with you on your technology journey and help you achieve your business goals.'),
(7, 'Innovative Inc', 'innovative@example.com', '21232f297a57a5a743894a0e4a801fc3', 789321654, 'Lebanon', 0, 'approved', 'Innovative Inc.jpg', 'https://www.innovativeinc.com', 'Innovative City', 'https://www.linkedin.com/company/innovative-inc', 'https://twitter.com/innovative', 'https://www.facebook.com/innovative', 'https://www.instagram.com/innovative', 'Innovative Inc is a dynamic and forward-thinking company that specializes in providing cutting-edge solutions and services to businesses worldwide. Our mission is to help organizations embrace innovation and leverage technology to drive growth and success.\r\n\r\n    At Innovative Inc, we have a passion for pushing boundaries and exploring new possibilities. Our team of experts excels in developing innovative software applications, implementing robust IT infrastructure, and providing strategic consulting services. We collaborate closely with our clients to understand their unique needs and deliver tailor-made solutions that exceed their expectations.\r\n\r\n    With our headquarters located in Innovative City, we have established a strong presence in the industry. Our commitment to excellence, customer satisfaction, and continuous improvement sets us apart. We believe in fostering long-term partnerships and delivering measurable results that make a real impact on our clients\' businesses.\r\n\r\n    Our company culture is characterized by creativity, teamwork, and a relentless pursuit of excellence. We invest in our employees\' professional development, providing them with the latest tools and training to stay at the forefront of technology advancements. This enables us to consistently deliver innovative and future-proof solutions to our clients.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated on our latest projects, thought leadership articles, and industry insights. We look forward to collaborating with you and driving your organization\'s success.'),
(13, 'Stellar Solutions', 'info@stellarsolutions.com', '21232f297a57a5a743894a0e4a801fc3', 9999999, 'United States', 0, 'approved', 'Stellar Solutions.jpeg', 'https://www.stellarsolutions.com', 'Stellar City', 'https://www.linkedin.com/company/stellar-solutions', 'https://twitter.com/stellar', 'https://www.facebook.com/stellar', 'https://www.instagram.com/stellar', 'Stellar Solutions is a leading provider of innovative and comprehensive solutions for businesses across various industries. We are dedicated to helping our clients succeed by delivering cutting-edge technology solutions and exceptional services.\r\n\r\n    At Stellar Solutions, we combine technical expertise, industry knowledge, and a customer-centric approach to deliver tailored solutions that address the unique challenges of our clients. Our team of experts works closely with organizations to understand their goals and requirements, ensuring that we provide the right solutions to drive their success.\r\n\r\n    With our headquarters based in Stellar City, we have a strong presence in the market. Our commitment to excellence, quality, and customer satisfaction sets us apart. We strive to exceed expectations and build long-term partnerships with our clients.\r\n\r\n    Our company culture is built on a foundation of innovation, collaboration, and continuous learning. We invest in our employees\' professional growth and foster a dynamic and supportive work environment. This enables us to stay at the forefront of technological advancements and deliver innovative solutions that meet the evolving needs of our clients.\r\n\r\n    Connect with us on LinkedIn, Twitter, Facebook, and Instagram to stay updated on our latest projects, industry insights, and company news. We are excited to partner with you and contribute to your organization\'s success.');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile_views`
--

CREATE TABLE `company_profile_views` (
  `company_Profile_Views_ID` int(11) NOT NULL,
  `company_id` int(10) NOT NULL,
  `view_date` date NOT NULL,
  `viewer` varchar(10) NOT NULL,
  `viewer_Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_profile_views`
--

INSERT INTO `company_profile_views` (`company_Profile_Views_ID`, `company_id`, `view_date`, `viewer`, `viewer_Email`) VALUES
(1, 13, '2023-05-20', 'company', 'abc@example.com'),
(2, 13, '2023-05-20', 'company', 'abc@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'Afghanistan'),
(2, 'Albania'),
(3, 'Algeria'),
(4, 'Andorra'),
(5, 'Angola'),
(6, 'Antigua and Barbuda'),
(7, 'Argentina'),
(8, 'Armenia'),
(9, 'Australia'),
(10, 'Austria'),
(11, 'Azerbaijan'),
(12, 'Bahamas'),
(13, 'Bahrain'),
(14, 'Bangladesh'),
(15, 'Barbados'),
(16, 'Belarus'),
(17, 'Belgium'),
(18, 'Belize'),
(19, 'Benin'),
(20, 'Bhutan'),
(21, 'Bolivia'),
(22, 'Bosnia and Herzegovina'),
(23, 'Botswana'),
(24, 'Brazil'),
(25, 'Brunei'),
(26, 'Bulgaria'),
(27, 'Burkina Faso'),
(28, 'Burundi'),
(29, 'Cabo Verde'),
(30, 'Cambodia'),
(31, 'Cameroon'),
(32, 'Canada'),
(33, 'Central African Republic'),
(34, 'Chad'),
(35, 'Chile'),
(36, 'China'),
(37, 'Colombia'),
(38, 'Comoros'),
(39, 'Congo, Democratic Republic of the'),
(40, 'Congo, Republic of the'),
(41, 'Costa Rica'),
(42, 'Cote d\'Ivoire'),
(43, 'Croatia'),
(44, 'Cuba'),
(45, 'Cyprus'),
(46, 'Czech Republic'),
(47, 'Denmark'),
(48, 'Djibouti'),
(49, 'Dominica'),
(50, 'Dominican Republic'),
(51, 'East Timor'),
(52, 'Ecuador'),
(53, 'Egypt'),
(54, 'El Salvador'),
(55, 'Equatorial Guinea'),
(56, 'Eritrea'),
(57, 'Estonia'),
(58, 'Eswatini'),
(59, 'Ethiopia'),
(60, 'Fiji'),
(61, 'Finland'),
(62, 'France'),
(63, 'Gabon'),
(64, 'Gambia'),
(65, 'Georgia'),
(66, 'Germany'),
(67, 'Ghana'),
(68, 'Greece'),
(69, 'Grenada'),
(70, 'Guatemala'),
(71, 'Guinea'),
(72, 'Guinea-Bissau'),
(73, 'Guyana'),
(74, 'Haiti'),
(75, 'Honduras'),
(76, 'Hungary'),
(77, 'Iceland'),
(78, 'India'),
(79, 'Indonesia'),
(80, 'Iran'),
(81, 'Iraq'),
(82, 'Ireland'),
(83, 'Israel'),
(84, 'Italy'),
(85, 'Jamaica'),
(86, 'Japan'),
(87, 'Jordan'),
(88, 'Kazakhstan'),
(89, 'Kenya'),
(90, 'Kiribati'),
(91, 'Korea, North'),
(92, 'Korea, South'),
(93, 'Kosovo'),
(94, 'Kuwait'),
(95, 'Kyrgyzstan'),
(96, 'Laos'),
(97, 'Latvia'),
(98, 'Lebanon'),
(99, 'Lesotho'),
(100, 'Liberia'),
(101, 'Libya'),
(102, 'Liechtenstein'),
(103, 'Lithuania'),
(104, 'Luxembourg'),
(105, 'Madagascar'),
(106, 'Malawi'),
(107, 'Malaysia'),
(108, 'Maldives'),
(109, 'Mali'),
(110, 'Malta'),
(111, 'Marshall Islands'),
(112, 'Mauritania'),
(113, 'Mauritius'),
(114, 'Mexico'),
(115, 'Micronesia'),
(116, 'Moldova'),
(117, 'Monaco'),
(118, 'Mongolia'),
(119, 'Montenegro'),
(120, 'Morocco'),
(121, 'Mozambique'),
(122, 'Myanmar'),
(123, 'Namibia'),
(124, 'Nauru'),
(125, 'Nepal'),
(126, 'Netherlands'),
(127, 'New Zealand'),
(128, 'Nicaragua'),
(129, 'Niger'),
(130, 'Nigeria'),
(131, 'North Macedonia'),
(132, 'Norway'),
(133, 'Oman'),
(134, 'Pakistan'),
(135, 'Palau'),
(136, 'Panama'),
(137, 'Papua New Guinea'),
(138, 'Paraguay'),
(139, 'Peru'),
(140, 'Philippines'),
(141, 'Poland'),
(142, 'Portugal'),
(143, 'Qatar'),
(144, 'Romania'),
(145, 'Russia'),
(146, 'Rwanda'),
(147, 'Saint Kitts and Nevis'),
(148, 'Saint Lucia'),
(149, 'Saint Vincent and the Grenadines'),
(150, 'Samoa'),
(151, 'San Marino'),
(152, 'Sao Tome and Principe'),
(153, 'Saudi Arabia'),
(154, 'Senegal'),
(155, 'Serbia'),
(156, 'Seychelles'),
(157, 'Sierra Leone'),
(158, 'Singapore'),
(159, 'Slovakia'),
(160, 'Slovenia'),
(161, 'Solomon Islands'),
(162, 'Somalia'),
(163, 'South Africa'),
(164, 'South Sudan'),
(165, 'Spain'),
(166, 'Sri Lanka'),
(167, 'Sudan'),
(168, 'Suriname'),
(169, 'Sweden'),
(170, 'Switzerland'),
(171, 'Syria'),
(172, 'Taiwan'),
(173, 'Tajikistan'),
(174, 'Tanzania'),
(175, 'Thailand'),
(176, 'Togo'),
(177, 'Tonga'),
(178, 'Trinidad and Tobago'),
(179, 'Tunisia'),
(180, 'Turkey'),
(181, 'Turkmenistan'),
(182, 'Tuvalu'),
(183, 'Uganda'),
(184, 'Ukraine'),
(185, 'United Arab Emirates'),
(186, 'United Kingdom'),
(187, 'United States'),
(188, 'Uruguay'),
(189, 'Uzbekistan'),
(190, 'Vanuatu'),
(191, 'Vatican City'),
(192, 'Venezuela'),
(193, 'Vietnam'),
(194, 'Yemen'),
(195, 'Zambia'),
(196, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_ID` int(11) NOT NULL,
  `course_Name` varchar(50) NOT NULL,
  `course_Description` text NOT NULL,
  `course_Creator` varchar(50) NOT NULL,
  `course_Category` varchar(50) NOT NULL,
  `course_Picture` text NOT NULL,
  `course_overall_Video` text NOT NULL,
  `course_Fees` int(11) NOT NULL,
  `course_Status` varchar(10) NOT NULL,
  `course_Launch_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_ID`, `course_Name`, `course_Description`, `course_Creator`, `course_Category`, `course_Picture`, `course_overall_Video`, `course_Fees`, `course_Status`, `course_Launch_Date`) VALUES
(1, 'Introduction to Computer Science', 'This course will introduce you to the foundational concepts of computer science by teaching you how to think algorithmically and solve problems using programming. You will learn what algorithms are, how to design them to solve problems, and how to analyze their efficiency. You will also learn the basics of a computer programming language like Python or JavaScript covering functions, conditionals, loops, variables, objects and classes.\n\nIn addition, you will study common data structures like arrays, lists, stacks, queues, trees and hash tables and how to implement and utilize them efficiently. You will be introduced to approaches for designing large software programs and gain an understanding of how computers work at a fundamental level.\n\nThroughout the course you will develop computational thinking skills like abstraction, decomposition, algorithm design and evaluation. This introductory course aims to prepare you with a solid foundation in computer science that you can build upon in your future studies and the thinking skills you develop will be applicable across engineering, science and many other disciplines.', 'XYZ University', 'Programming', 'whatisComputerScience.jpg', 'Introduction to Computer Science _ CS for Beginners.mp4', 100, 'active', '2023-05-25'),
(2, 'Data Science and Analytics', 'Data Science and Analytics is a comprehensive course designed to equip students with the skills and knowledge necessary to excel in the rapidly evolving field of data analysis. This course delves into the fundamentals of data science, exploring various techniques and tools used to extract insights from large and complex datasets. Students will learn how to collect, clean, and organize data, as well as apply statistical and mathematical models to uncover patterns, trends, and correlations.\n\nThroughout the course, students will be introduced to programming languages commonly used in data science, such as Python and R, and gain hands-on experience in manipulating data and implementing algorithms. They will also be exposed to machine learning algorithms, which enable them to build predictive models and make data-driven decisions.\n\nIn addition to technical skills, the course emphasizes the importance of critical thinking and problem-solving abilities. Students will learn how to interpret and communicate their findings effectively, transforming raw data into actionable insights that drive business strategies and decision-making. Ethical considerations surrounding data privacy, security, and bias will also be addressed, ensuring that students develop a responsible and ethical approach to data analysis.\n\nBy the end of the course, students will have a solid foundation in data science and analytics, enabling them to tackle real-world challenges in various domains, such as finance, healthcare, marketing, and more. They will possess the skills to extract valuable information from complex datasets, make data-driven decisions, and contribute to the growing field of data science, where their expertise is in high demand.', 'ABC Corporation', 'Data Science', 'Data Science and Analytics.jpg', '', 150, 'active', '2023-05-25'),
(3, 'Web Development Bootcamp', 'The Web Development Bootcamp is an intensive and immersive training program designed to equip individuals with the skills and knowledge needed to become proficient web developers. This comprehensive course covers all aspects of web development, from the basics of HTML, CSS, and JavaScript to more advanced topics such as front-end and back-end frameworks, databases, and server management.\n\nThroughout the bootcamp, students will engage in hands-on exercises and projects that simulate real-world scenarios, allowing them to apply their newly acquired skills in a practical manner. They will learn how to design and build visually appealing and responsive websites, incorporating interactive elements and user-friendly interfaces. Students will also gain an understanding of web development best practices, including optimization techniques for performance and search engine optimization (SEO).\n\nThe curriculum typically includes training on popular front-end frameworks such as React or Angular, enabling students to create dynamic and interactive web applications. Additionally, students will dive into back-end development, learning how to build server-side applications and interact with databases using technologies such as Node.js and MongoDB. They will also explore topics related to version control, deployment strategies, and security considerations.\n\nIn addition to technical skills, the bootcamp may also emphasize collaboration, problem-solving, and critical thinking abilities. Students often work in teams to complete projects, mirroring real-world development environments. They will learn how to effectively communicate and collaborate with other developers, as well as understand the iterative and agile nature of web development.\n\nUpon completion of the Web Development Bootcamp, students will have a strong foundation in web development and be well-equipped to pursue careers as front-end or back-end developers, full-stack developers, or even freelance web developers. The program aims to provide individuals with the necessary skills to thrive in the rapidly evolving field of web development, where demand for talented professionals continues to grow.', 'Tech Solutions', 'Web Development', 'Web Development Bootcamp.jpg', '', 200, 'active', '2023-05-25'),
(4, 'Introduction to Artificial Intelligence', 'Introduction to Artificial Intelligence is a comprehensive course that introduces students to the fundamental concepts, techniques, and applications of AI. In this course, students explore the exciting field of AI, which focuses on the development of intelligent systems that can perceive, reason, learn, and make decisions similar to human intelligence.\n\nThroughout the course, students delve into various topics, starting with the basics of AI and its historical background. They learn about different AI approaches, including symbolic AI, machine learning, and deep learning, and gain an understanding of the algorithms and methodologies used in each approach. Students also explore key concepts such as problem-solving, knowledge representation, natural language processing, computer vision, and robotics.\n\nThe course often involves hands-on programming exercises and projects that allow students to apply AI concepts and techniques in practical scenarios. They learn how to implement AI algorithms using programming languages such as Python and utilize popular libraries and frameworks. Students also gain insights into data collection, preprocessing, and feature engineering, which are essential for training AI models.\n\nEthical considerations and societal impacts of AI are also addressed in the course. Students examine topics such as bias in AI algorithms, privacy concerns, and the responsible use of AI in different domains. They learn to think critically about the implications of AI on society, including its potential benefits and challenges.\n\nBy the end of the course, students will have a solid foundation in the principles and techniques of AI. They will understand how AI algorithms work and how they can be applied to solve real-world problems. This knowledge opens up a wide range of career opportunities in fields such as machine learning, data science, natural language processing, computer vision, robotics, and AI research. Additionally, students will be equipped to navigate the ethical considerations and challenges associated with the development and deployment of AI technologies.', 'Stellar Solutions', 'Artificial Intelligence', 'Introduction to Artificial Intelligence.jpg', '', 130, 'active', '2023-05-25'),
(5, 'Business Management Essentials', 'Business Management Essentials is a comprehensive course designed to provide students with a foundational understanding of the key principles and practices involved in managing a business effectively. This course covers a wide range of topics essential for aspiring managers and entrepreneurs, enabling them to make informed decisions and lead teams to success.\n\nThroughout the course, students are introduced to various aspects of business management, including strategic planning, organizational behavior, marketing, finance, operations, and human resources. They gain insights into how businesses operate in different environments, learn to analyze market trends, identify opportunities, and develop strategies to achieve competitive advantage.\n\nThe course emphasizes the importance of effective leadership and communication skills in managing teams and driving organizational success. Students learn how to motivate employees, foster teamwork, and resolve conflicts. They also explore the principles of organizational structure and culture, as well as the dynamics of decision-making and problem-solving within a business context.\n\nFurthermore, students gain an understanding of financial management, including budgeting, financial analysis, and forecasting. They learn how to interpret financial statements, assess business performance, and make data-driven decisions to maximize profitability and sustainability.\n\nEthical considerations in business management are also addressed throughout the course. Students explore topics such as corporate social responsibility, ethical decision-making, and sustainability. They develop a broader perspective on the role of businesses in society and learn to integrate ethical principles into their managerial practices.\n\nBy the end of the course, students will have a solid foundation in business management essentials, equipping them with the skills and knowledge necessary to navigate the complexities of the business world. They will be prepared to take on managerial roles, start their own ventures, or pursue further studies in business-related fields. This course sets the stage for lifelong learning and growth as business professionals, empowering individuals to contribute to the success and sustainability of organizations in diverse industries.', 'Global Enterprises', 'Business', 'Business Management Essentials.png', '', 80, 'active', '2023-05-25'),
(6, 'Mobile App Development with Flutter', 'Mobile App Development with Flutter is a comprehensive course designed to equip students with the skills and knowledge needed to develop cross-platform mobile applications using the Flutter framework. Flutter is a popular open-source framework developed by Google that allows developers to build high-quality and visually appealing mobile apps for both Android and iOS platforms using a single codebase.\n\nThroughout the course, students learn the basics of mobile app development, including user interface (UI) design, navigation, and app architecture. They gain hands-on experience in using Flutter\'s widgets and layouts to create interactive and responsive user interfaces. Students also explore Flutter\'s rich set of pre-built UI components and themes, enabling them to create visually appealing apps with ease.\n\nThe course covers essential topics such as working with data, handling user input, and integrating with external APIs. Students learn how to manage app state, persist data, and implement features like authentication, data fetching, and push notifications. They also gain insights into debugging, testing, and optimizing Flutter apps to ensure a smooth and efficient user experience.\n\nFurthermore, students explore platform-specific integrations and advanced features of Flutter. They learn how to access device features such as camera, location, and sensors, as well as how to work with platform-specific APIs and services. Students also gain an understanding of app deployment, including publishing apps to the Google Play Store and Apple App Store.\n\nThe course often includes hands-on projects and assignments that allow students to apply their knowledge and skills to real-world app development scenarios. By working on practical projects, students gain experience in building complete mobile apps from start to finish, incorporating best practices and industry standards.\n\nUpon completion of the course, students will have a solid foundation in mobile app development with Flutter. They will be able to develop cross-platform mobile applications that run smoothly on both Android and iOS devices, reducing development time and cost. With Flutter\'s growing popularity and demand for skilled Flutter developers, students will have excellent prospects for pursuing careers as mobile app developers or freelancers in the rapidly expanding mobile app industry.', 'Tech Solutions', 'Mobile Development', 'Mobile App Development with Flutter.jpg', '', 150, 'active', '2023-05-25'),
(7, 'Digital Marketing Fundamentals', 'Digital marketing includes all marketing efforts that use digital technologies, such as the internet, mobile phones, and other digital media and platforms. This course will introduce you to the fundamental concepts and strategies of digital marketing.\n\nYou will learn about different digital marketing channels like search engine optimization (SEO), search engine marketing (SEM), social media marketing, content marketing, email marketing, mobile marketing and more. You will learn the strengths and weaknesses of each channel and how to use them effectively in an integrated marketing strategy.\n\nThe course will cover key digital marketing concepts like the customer journey, conversion rate optimization, measurement and analytics, inbound vs outbound marketing, and content strategy. You will develop an understanding of the digital marketing landscape and how to utilize digital channels to achieve marketing goals, drive traffic, generate leads and increase sales. With an agile approach that incorporates data and experimentation, you will learn how to measure and improve the performance of your digital marketing efforts.', 'Global Enterprises', 'Marketing', 'Digital Marketing Fundamentals.jpg', '', 100, 'active', '2023-05-25'),
(12, 'Introduction to Programming', 'This course will teach you the fundamentals of computer programming. You will learn how to think like a computer scientist and solve problems algorithmically. The focus will be on learning programming concepts like data types, variables, conditionals, loops, functions, classes, and objects.\n\nWe will use a high-level language like Python or JavaScript to put the concepts into practice. You will learn how to develop programs that utilize important programming constructs like conditionals (if/then statements), loops (for/while), and functions. The course will introduce different data structures like lists, stacks, queues, and dictionaries that enable the manipulation of data.\n\nObject-oriented programming principles will be covered including encapsulation, inheritance, and polymorphism. You will learn software engineering best practices like modular code design, testing, and documentation. The goal is to provide you with a solid foundation in programming that you can build on to learn more advanced languages and techniques. Along the way you will develop problem-solving and logical thinking skills that are applicable in any technical field.', 'Lebanese International University', 'Computer Science', 'Introduction to Programming.jpeg', '', 100, 'active', '2023-05-29'),
(13, 'Web Development Fundamentals', 'This course introduces you to the core technologies used to build modern websites. You will learn HTML, the fundamental markup language used to structure web pages. You\'ll learn how to use HTML to render text, images, hyperlinks, tables, lists, forms, and more.\n\nYou will also learn Cascading Style Sheets (CSS) for styling and laying out your HTML. CSS allows you to control things like font styles, colors, spacing, and positioning of elements. The course covers JavaScript, a programming language that adds interactivity to web pages. You\'ll learn JavaScript fundamentals as well as DOM manipulation to dynamically update webpage content.\n\nThe course introduces responsive web design to make websites look good on all devices. You\'ll also learn about server-side technologies like PHP and server-side frameworks. Through hands-on projects, you\'ll gain experience planning and designing web pages, writing HTML, CSS and JavaScript, and debugging code. By the end of the course, you\'ll have a solid foundation in the core technologies underlying modern web development - HTML, CSS, and JavaScript.', 'Lebanese International University', 'Web Development', 'Web Development Fundamentals.png', '', 150, 'active', '2023-05-29'),
(14, 'Database Management Systems', 'Database Management Systems (DBMS) is a course that focuses on the principles, concepts, and techniques involved in designing, implementing, and managing databases. In this course, students learn about the fundamental components of DBMS and how they facilitate the efficient storage, retrieval, and manipulation of data.\n\nThroughout the course, students explore various database models, including relational, hierarchical, and network models. They learn about data modeling techniques, such as entity-relationship (ER) modeling, and gain an understanding of how to design logical and physical database structures to meet specific requirements.\n\nThe course covers the query language SQL (Structured Query Language) extensively, as it is widely used to interact with relational databases. Students learn how to write SQL queries to retrieve, insert, update, and delete data from databases. They also gain insights into database normalization, which involves eliminating redundancy and improving data integrity.\n\nStudents are introduced to the concepts of database transactions, concurrency control, and recovery mechanisms. They learn about ACID (Atomicity, Consistency, Isolation, Durability) properties and techniques for ensuring data consistency and integrity in multi-user environments.\n\nFurthermore, students explore advanced topics in database management systems, including indexing, query optimization, and database security. They learn how to optimize query performance through indexing techniques and understand the importance of database security measures to protect sensitive data.\n\nThe course often includes practical assignments and projects where students get hands-on experience in working with real-world database management systems. They learn to use popular database management systems such as MySQL, Oracle, or Microsoft SQL Server and gain proficiency in designing and implementing databases.\n\nUpon completion of the course, students will have a strong foundation in database management systems. They will be equipped with the skills to design, implement, and manage databases effectively, ensuring data integrity, availability, and security. This knowledge is valuable in various fields where data management is critical, such as software development, data analysis, and information systems management. Students will be well-prepared to pursue careers as database administrators, data analysts, or database developers, or they can further their studies in specialized areas of database management systems.', 'Lebanese International University', 'Database Management', 'Database Management Systems.jpg', '', 120, 'active', '2023-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `courses_fields`
--

CREATE TABLE `courses_fields` (
  `courses_field_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `course_field_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses_fields`
--

INSERT INTO `courses_fields` (`courses_field_ID`, `course_ID`, `course_field_Name`) VALUES
(1, 1, 'Data Science'),
(2, 1, 'Programming'),
(3, 1, 'Machine Learning'),
(4, 1, 'Artificial Intelligence'),
(5, 2, 'Data Science'),
(6, 2, 'Programming'),
(7, 2, 'Machine Learning'),
(8, 2, 'Artificial Intelligence'),
(9, 3, 'Data Science'),
(10, 3, 'Programming'),
(11, 3, 'Machine Learning'),
(12, 3, 'Artificial Intelligence'),
(13, 4, 'Data Science'),
(14, 4, 'Programming'),
(15, 4, 'Machine Learning'),
(16, 4, 'Artificial Intelligence'),
(17, 6, 'Programming'),
(18, 12, 'Data Science'),
(19, 12, 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `course_progress`
--

CREATE TABLE `course_progress` (
  `course_progress_ID` int(11) NOT NULL,
  `individual_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `last_watched_video` int(11) NOT NULL,
  `course_Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_progress`
--

INSERT INTO `course_progress` (`course_progress_ID`, `individual_ID`, `course_ID`, `last_watched_video`, `course_Status`) VALUES
(2, 1, 3, 2, 'done'),
(3, 1, 1, 1, 'under-progress');

-- --------------------------------------------------------

--
-- Table structure for table `course_videos`
--

CREATE TABLE `course_videos` (
  `video_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `video_Name` text NOT NULL,
  `video_Description` text NOT NULL,
  `video_Position_Name` text NOT NULL,
  `video_Picture` text NOT NULL,
  `video_Order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_videos`
--

INSERT INTO `course_videos` (`video_ID`, `course_ID`, `video_Name`, `video_Description`, `video_Position_Name`, `video_Picture`, `video_Order`) VALUES
(1, 1, 'What is Computer Science?', 'Computer science is the study of the theoretical foundations of information and computation. This video provides an overview of what computer science is, the main subfields within it, and some of the jobs and careers associated with it.', 'Computer Science Basics Hardware and Software.mp4', 'whatisComputerScience.jpg', 1),
(2, 1, 'Algorithms and Problem Solving', 'Algorithms are the heart of computer science. This video discusses what algorithms are, how to design efficient algorithms to solve problems, and some examples of common algorithmic approaches.', 'Computer Science Basics_ Algorithms.mp4', 'computer-algorithm-science-problem-solving-process-with-programming-GD97BB.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(255) NOT NULL,
  `feedback_email` varchar(50) NOT NULL,
  `feedback_message` text NOT NULL,
  `feedback_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_email`, `feedback_message`, `feedback_status`) VALUES
(2, 'user1@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget dui ultricies, lobortis dolor id, dignissim nisl. Fusce commodo mauris a vestibulum pharetra. Suspendisse in bibendum nisi. Nulla facilisi. Sed non est in turpis commodo tempor. Phasellus consectetur elit ut sollicitudin sagittis. Sed condimentum purus et nunc vehicula blandit. Integer in varius lectus. Nulla facilisi.', 'Pending'),
(3, 'user2@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget dui ultricies, lobortis dolor id, dignissim nisl. Fusce commodo mauris a vestibulum pharetra. Suspendisse in bibendum nisi. Nulla facilisi. Sed non est in turpis commodo tempor. Phasellus consectetur elit ut sollicitudin sagittis. Sed condimentum purus et nunc vehicula blandit. Integer in varius lectus. Nulla facilisi.', 'Resolved'),
(4, 'user3@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum eget dui ultricies, lobortis dolor id, dignissim nisl. Fusce commodo mauris a vestibulum pharetra. Suspendisse in bibendum nisi. Nulla facilisi. Sed non est in turpis commodo tempor. Phasellus consectetur elit ut sollicitudin sagittis. Sed condimentum purus et nunc vehicula blandit. Integer in varius lectus. Nulla facilisi.', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `individuals`
--

CREATE TABLE `individuals` (
  `individual_ID` int(11) NOT NULL,
  `individual_Name` varchar(50) NOT NULL,
  `individual_Password` varchar(50) NOT NULL,
  `individual_Email` varchar(50) NOT NULL,
  `individual_PhoneNumber` int(50) NOT NULL,
  `individual_Major` varchar(50) NOT NULL,
  `Is_Graduated` tinyint(1) NOT NULL,
  `individual_Country` varchar(50) NOT NULL,
  `individual_photo` int(11) NOT NULL,
  `individual_Status` varchar(10) NOT NULL,
  `individual_JoinDate` date NOT NULL DEFAULT current_timestamp(),
  `individual_Linkedin` varchar(255) NOT NULL,
  `individual_About` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individuals`
--

INSERT INTO `individuals` (`individual_ID`, `individual_Name`, `individual_Password`, `individual_Email`, `individual_PhoneNumber`, `individual_Major`, `Is_Graduated`, `individual_Country`, `individual_photo`, `individual_Status`, `individual_JoinDate`, `individual_Linkedin`, `individual_About`) VALUES
(1, 'John Doe', '21232f297a57a5a743894a0e4a801fc3', 'johndoe@example.com', 1234567890, 'Computer Engineering', 1, 'Lebanon', 0, 'approved', '2023-05-15', 'https://www.linkedin.com/', 'John Doe is a Computer Engineering graduate with a strong interest in the fields of Artificial Intelligence, Internet of Things, Machine Learning, and IT Support. With a solid educational background and expertise in computer engineering, John is well-equipped to tackle complex challenges in these areas. He possesses a deep understanding of cutting-edge technologies and is passionate about leveraging them to drive innovation and solve real-world problems. John\'s enthusiasm for continuous learning and his ability to adapt to new technologies make him a valuable asset in the ever-evolving tech industry.'),
(2, 'Jane Smith', '21232f297a57a5a743894a0e4a801fc3', 'janesmith@example.com', 2147483647, 'Business Administration', 0, 'United States', 0, 'blocked', '2023-05-15', '', ''),
(3, 'Mike Johnson', '21232f297a57a5a743894a0e4a801fc3', 'mikejohnson@example.com', 2147483647, 'Electrical Engineering', 1, 'Qatar', 0, 'blocked', '2023-05-15', '', ''),
(4, 'Sarah Williams', '21232f297a57a5a743894a0e4a801fc3', 'sarahwilliams@example.com', 2147483647, 'Psychology', 0, 'United Arab Emirates', 0, 'pending', '2023-05-15', '', ''),
(5, 'Emily Johnson', '21232f297a57a5a743894a0e4a801fc3', 'emily@example.com', 1111111111, 'Mathematics', 0, 'Lebanon', 0, 'approved', '2023-05-15', '', ''),
(6, 'Robert Davis', '21232f297a57a5a743894a0e4a801fc3', 'robert@example.com', 2147483647, 'Chemistry', 1, 'Lebanon', 0, 'blocked', '2023-05-15', '', ''),
(7, 'Lisa Thompson', '21232f297a57a5a743894a0e4a801fc3', 'lisa@example.com', 21232, 'English Literature', 0, 'Turkey', 0, 'approved', '2023-05-15', '', ''),
(12, '', '21232f297a57a5a743894a0e4a801fc3', 'individual1@gmail.com', 0, '', 0, 'Lebanon', 0, 'approved', '2023-05-21', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `individual_intrested_field`
--

CREATE TABLE `individual_intrested_field` (
  `Intrested_Field_ID` int(11) NOT NULL,
  `individual_ID` int(11) NOT NULL,
  `field_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `individual_intrested_field`
--

INSERT INTO `individual_intrested_field` (`Intrested_Field_ID`, `individual_ID`, `field_Name`) VALUES
(170, 1, 'Programming'),
(171, 1, 'Artificial Intelligence'),
(172, 1, 'Cybersecurity'),
(173, 1, 'Internet of Things'),
(174, 1, 'Machine Learning'),
(175, 1, 'IT Support');

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE `internship` (
  `internship_ID` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `company` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `applicant_ID` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `deliveredBy` varchar(50) NOT NULL,
  `job_Country` varchar(50) NOT NULL,
  `jobType` varchar(50) NOT NULL,
  `job_WorkPlace` varchar(10) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `educationLevel` varchar(50) NOT NULL,
  `jobDescription` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `job_apply_link` text NOT NULL,
  `applicationDeadline` varchar(50) NOT NULL,
  `postedDate` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `salaryRange` varchar(50) NOT NULL,
  `jobStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `position`, `deliveredBy`, `job_Country`, `jobType`, `job_WorkPlace`, `industry`, `educationLevel`, `jobDescription`, `skills`, `job_apply_link`, `applicationDeadline`, `postedDate`, `salaryRange`, `jobStatus`) VALUES
(1, 'Software Engineer', 'ABC Corporation', 'United States', 'Full-time', 'On-site', 'Technology', 'Bachelor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac eleifend risus, ac efficitur justo. Sed finibus eu lorem ac aliquam.', 'JavaScript, HTML, CSS', 'https://www.google.com/forms/about/', '2023-06-30', '2023-05-01', '$60,000 - $80,000', 'Open'),
(2, 'Marketing Specialist', 'Global Enterprises', 'Lebanon', 'Part-time', 'Remote', 'Marketing', 'Bachelor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac eleifend risus, ac efficitur justo. Sed finibus eu lorem ac aliquam.', 'Digital Marketing, Social Media Management', 'https://forms.office.com/Pages/DesignPageV2.aspx?subpage=creationv2', '2023-07-15', '2023-05-05', '$40,000 - $50,000', 'Open'),
(3, 'Data Analyst Intern', 'Tech Solutions', 'Lebanon', 'Full-time', 'Hybrid', 'Technology', 'Bachelor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque ac eleifend risus, ac efficitur justo. Sed finibus eu lorem ac aliquam.', 'SQL, Python, Data Analysis', 'https://forms.office.com/Pages/DesignPageV2.aspx?subpage=creationv2', '2023-07-31', '2023-05-10', 'Unpaid', 'Open'),
(4, 'IT Support Specialist', 'Lebanese International University', 'Lebanon', 'Full-time', 'On-site', 'IT', 'Bachelor\'s Degree', 'Job description goes here', 'Technical Troubleshooting, Network Administration, Help Desk Support', 'https://example.com/apply', '2023-06-30', '2023-05-28', '$40,000 - $50,000', 'open'),
(5, 'Data Analyst', 'Lebanese International University', 'Lebanon', 'Full-time', 'Hybrid', 'Computer Science', 'Bachelor\'s Degree', 'Job description goes here', 'Python, SQL, Data Analysis', 'https://example.com/apply', '2023-06-30', '2023-05-29 01:41:44', '$40,000 - $50,000', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `job_fields`
--

CREATE TABLE `job_fields` (
  `job_fields_ID` int(11) NOT NULL,
  `job_ID` int(11) NOT NULL,
  `job_field_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_fields`
--

INSERT INTO `job_fields` (`job_fields_ID`, `job_ID`, `job_field_Name`) VALUES
(1, 3, 'Artificial Intelligence'),
(2, 3, 'IT Support'),
(3, 3, 'Cybersecurity'),
(4, 4, 'IT Support'),
(5, 5, 'Artificial Intelligence');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`) VALUES
(1, 'Accounting'),
(2, 'Aerospace Engineering'),
(3, 'Agricultural Engineering'),
(4, 'Anthropology'),
(5, 'Archaeology'),
(6, 'Architecture'),
(7, 'Art'),
(8, 'Art History'),
(9, 'Astronomy'),
(10, 'Biochemistry'),
(11, 'Biology'),
(12, 'Biomedical Engineering'),
(13, 'Business'),
(14, 'Chemistry'),
(15, 'Civil Engineering'),
(16, 'Computer Engineering'),
(17, 'Computer Science'),
(18, 'Criminal Justice'),
(19, 'Dance'),
(20, 'Economics'),
(21, 'Education'),
(22, 'Electrical Engineering'),
(23, 'English'),
(24, 'Environmental Engineering'),
(25, 'Ethics'),
(26, 'Finance'),
(27, 'Film Studies'),
(28, 'Fine Arts'),
(29, 'French'),
(30, 'Geography'),
(31, 'Geology'),
(32, 'German'),
(33, 'Government'),
(34, 'History'),
(35, 'Information Technology'),
(36, 'International Relations'),
(37, 'Italian'),
(38, 'Journalism'),
(39, 'Law'),
(40, 'Linguistics'),
(41, 'Literature'),
(42, 'Management'),
(43, 'Marketing'),
(44, 'Mathematics'),
(45, 'Mechanical Engineering'),
(46, 'Media Studies'),
(47, 'Music'),
(48, 'Nursing'),
(49, 'Philosophy'),
(50, 'Physics'),
(51, 'Political Science'),
(52, 'Psychology'),
(53, 'Public Administration'),
(54, 'Religious Studies'),
(55, 'Russian'),
(56, 'Spanish'),
(57, 'Speech Communication'),
(58, 'Statistics'),
(59, 'Theatre'),
(60, 'Urban Planning'),
(61, 'Women\'s Studies');

-- --------------------------------------------------------

--
-- Table structure for table `save_jobs_for_individuals`
--

CREATE TABLE `save_jobs_for_individuals` (
  `save_job_ID` int(11) NOT NULL,
  `save_job_individual_ID` int(11) NOT NULL,
  `job_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `scholarships_ID` int(50) NOT NULL,
  `unversityName` varchar(100) NOT NULL,
  `degree` varchar(200) NOT NULL,
  `major` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE `universities` (
  `university_ID` int(50) NOT NULL,
  `university_Name` varchar(100) NOT NULL,
  `university_acronym` varchar(10) NOT NULL,
  `university_Email` varchar(50) NOT NULL,
  `university_password` varchar(50) NOT NULL,
  `university_phoneNumber` int(30) NOT NULL,
  `university_country` varchar(50) NOT NULL,
  `university_Logo` varchar(255) NOT NULL,
  `university_Status` varchar(10) NOT NULL,
  `university_About` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`university_ID`, `university_Name`, `university_acronym`, `university_Email`, `university_password`, `university_phoneNumber`, `university_country`, `university_Logo`, `university_Status`, `university_About`) VALUES
(1, 'Lebanese International University', 'LIU', 'liu@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 12345678, 'Lebanon', 'liu.png', 'approved', 'The Lebanese International University (LIU) is a private, non-protfit, independent institution of higher education governed by an autonomous Board of Trustees (Link to BOT). The University was established in 2001 under the name of Bekaa University in accordance with decree 5294 on April 9, 2001. The University is recognized by the Lebanese State as a private Higher Education Institution in Lebanon, according to the law of Higher Education Organizations in Lebanon. The University name was renamed the Lebanese International University, in accordance with decree 14592 on June 14, 2005.\r\n\r\nThe University has seen significant change over the years since its Founding. In order to bring the University and the nine campuses(link to campuses) together more fully as one community, several major new initiatives are at work on key campus improvements. At each of the campuses, the Campus Council meets, works collaboratively on policies and procedures, and seeks to disseminate critical information to all areas of the campus to create an environment conducive to excellence. Schools, Academic Program and Degrees\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `videos_comments`
--

CREATE TABLE `videos_comments` (
  `comment_ID` int(11) NOT NULL,
  `video_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `Commented_by` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `comment_Data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos_comments`
--

INSERT INTO `videos_comments` (`comment_ID`, `video_ID`, `course_ID`, `Commented_by`, `comment`, `comment_Data`) VALUES
(1, 1, 1, 'Lisa Thompson', 'Comment TEST', '2023-05-26'),
(2, 1, 1, 'John Doe', 'Comment2', '2023-05-26'),
(3, 1, 0, 'John Doe', 'Comment 3', '2023-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `video_progress`
--

CREATE TABLE `video_progress` (
  `video_progress_id` int(11) NOT NULL,
  `video_ID` int(11) NOT NULL,
  `individual_ID` int(11) NOT NULL,
  `watched_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_progress`
--

INSERT INTO `video_progress` (`video_progress_id`, `video_ID`, `individual_ID`, `watched_time`) VALUES
(1, 1, 1, 75),
(2, 2, 1, 107);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`bookmark_ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `company_profile_views`
--
ALTER TABLE `company_profile_views`
  ADD PRIMARY KEY (`company_Profile_Views_ID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `courses_fields`
--
ALTER TABLE `courses_fields`
  ADD PRIMARY KEY (`courses_field_ID`);

--
-- Indexes for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD PRIMARY KEY (`course_progress_ID`);

--
-- Indexes for table `course_videos`
--
ALTER TABLE `course_videos`
  ADD PRIMARY KEY (`video_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `individuals`
--
ALTER TABLE `individuals`
  ADD PRIMARY KEY (`individual_ID`);

--
-- Indexes for table `individual_intrested_field`
--
ALTER TABLE `individual_intrested_field`
  ADD PRIMARY KEY (`Intrested_Field_ID`);

--
-- Indexes for table `internship`
--
ALTER TABLE `internship`
  ADD PRIMARY KEY (`internship_ID`),
  ADD KEY `accounts_ID` (`applicant_ID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `job_fields`
--
ALTER TABLE `job_fields`
  ADD PRIMARY KEY (`job_fields_ID`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `save_jobs_for_individuals`
--
ALTER TABLE `save_jobs_for_individuals`
  ADD PRIMARY KEY (`save_job_ID`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`scholarships_ID`);

--
-- Indexes for table `universities`
--
ALTER TABLE `universities`
  ADD PRIMARY KEY (`university_ID`);

--
-- Indexes for table `videos_comments`
--
ALTER TABLE `videos_comments`
  ADD PRIMARY KEY (`comment_ID`);

--
-- Indexes for table `video_progress`
--
ALTER TABLE `video_progress`
  ADD PRIMARY KEY (`video_progress_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `bookmark_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `company_profile_views`
--
ALTER TABLE `company_profile_views`
  MODIFY `company_Profile_Views_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses_fields`
--
ALTER TABLE `courses_fields`
  MODIFY `courses_field_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course_progress`
--
ALTER TABLE `course_progress`
  MODIFY `course_progress_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_videos`
--
ALTER TABLE `course_videos`
  MODIFY `video_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `individuals`
--
ALTER TABLE `individuals`
  MODIFY `individual_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `individual_intrested_field`
--
ALTER TABLE `individual_intrested_field`
  MODIFY `Intrested_Field_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `internship`
--
ALTER TABLE `internship`
  MODIFY `internship_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_fields`
--
ALTER TABLE `job_fields`
  MODIFY `job_fields_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `save_jobs_for_individuals`
--
ALTER TABLE `save_jobs_for_individuals`
  MODIFY `save_job_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `scholarships_ID` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universities`
--
ALTER TABLE `universities`
  MODIFY `university_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos_comments`
--
ALTER TABLE `videos_comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `video_progress`
--
ALTER TABLE `video_progress`
  MODIFY `video_progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
