-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 10, 2014 at 10:34 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `mpower`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `history`
-- 

CREATE TABLE `history` (
  `userid` int(11) default NULL,
  `quizid` int(11) default NULL,
  `problemid` int(11) default NULL,
  `answer` int(11) default NULL,
  `time` double default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `history`
-- 

INSERT INTO `history` VALUES (1, 1, 2, 4, 7);
INSERT INTO `history` VALUES (1, 1, 1, 1, 3);
INSERT INTO `history` VALUES (1, 12, 12, 2, 9);
INSERT INTO `history` VALUES (1, 12, 11, 1, 4);
INSERT INTO `history` VALUES (1, 14, 15, 1, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `question`
-- 

CREATE TABLE `question` (
  `id` int(11) NOT NULL auto_increment,
  `quizid` int(11) default NULL,
  `problem` text,
  `subjectid` int(11) default NULL,
  `A` text,
  `B` text,
  `C` text,
  `D` text,
  `E` text,
  `answer` int(11) default NULL,
  `explanation` text,
  `time` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `question`
-- 

INSERT INTO `question` VALUES (1, 1, 'Find 1+1.', 43, '1', '2', '3', '4', '5', 1, 'Easy!', 10);
INSERT INTO `question` VALUES (2, 1, 'Find 2+2.', 43, '1', '2', '3', '4', '5', 3, 'Still easy!', 15);
INSERT INTO `question` VALUES (11, 12, 'Find sin(30).', 19, '0', '0.5', '1', '-1', '0.866', 0, 'Simple', 20);
INSERT INTO `question` VALUES (12, 12, 'What is the formula for cos(A-B)?', 58, 'sinAcosB + cosAsinB', 'sinAcosB - cosAsinB', 'cosAcosB + sinAsinB', 'cosAcosB - sinAsinB', 'sinAcosA - sinBcosB', 0, 'Don''t forget to reverse the sign!', 30);
INSERT INTO `question` VALUES (13, 13, 'If A = [1 2] and B = [2 3], find A-B.', 67, '[3 5]', '[1 1]', '[5 3]', '[2 6]', '[-1 -1]', 0, 'Element-wise operation', 15);
INSERT INTO `question` VALUES (14, 13, 'If A = [1 2 3 ; 3 4 5] and B = [2 3 ; -1 -3], which of the following operation is not executable.', 68, 'AB', 'BA', '(A^t)B', '(B^t)A', 'B^2', 0, 'The second dimension of the first matrix must agree with the first dimension of the second matrix.  (e.g.mxn multiplies nxk)', 35);
INSERT INTO `question` VALUES (15, 14, 'try1', 0, '1', '2', '3', '', '', 0, '', 120);

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz`
-- 

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL auto_increment,
  `title` text,
  `subjectid` int(11) default NULL,
  `noquestion` int(11) default NULL,
  `datecreation` datetime default NULL,
  `timelimit` double default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `quiz`
-- 

INSERT INTO `quiz` VALUES (1, 'Algebra-1', 1, 12, '2013-05-01 16:29:28', 1000);
INSERT INTO `quiz` VALUES (2, 'Algebra-2', 1, 15, '2013-05-01 16:31:40', 1400);
INSERT INTO `quiz` VALUES (3, 'Quadratic Functions-1', 15, 10, '2013-05-02 17:37:21', 1000);
INSERT INTO `quiz` VALUES (12, 'Trigonometry-1', 3, 2, '2013-06-02 20:35:17', 920);
INSERT INTO `quiz` VALUES (13, 'Basic Matrix Operations', 25, 2, '2013-06-03 22:12:07', 950);
INSERT INTO `quiz` VALUES (14, 'try', 1, 1, '2013-06-07 06:08:10', 902);

-- --------------------------------------------------------

-- 
-- Table structure for table `subject`
-- 

CREATE TABLE `subject` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  `parentid` int(11) default NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

-- 
-- Dumping data for table `subject`
-- 

INSERT INTO `subject` VALUES (1, 'Algebra', NULL);
INSERT INTO `subject` VALUES (2, 'Functions and Equations', NULL);
INSERT INTO `subject` VALUES (3, 'Trigonometry', NULL);
INSERT INTO `subject` VALUES (4, 'Matrices', NULL);
INSERT INTO `subject` VALUES (5, 'Vectors', NULL);
INSERT INTO `subject` VALUES (6, 'Statistics and Probability', NULL);
INSERT INTO `subject` VALUES (7, 'Elementary Calculus', NULL);
INSERT INTO `subject` VALUES (8, 'Sequences and Series', 1);
INSERT INTO `subject` VALUES (9, 'Exponents and Logarithms', 1);
INSERT INTO `subject` VALUES (10, 'Binomial Theorem', 1);
INSERT INTO `subject` VALUES (11, 'Intro to Functions', 2);
INSERT INTO `subject` VALUES (12, 'Graphs of Functions', 2);
INSERT INTO `subject` VALUES (13, 'Transformation', 2);
INSERT INTO `subject` VALUES (14, 'Reciprocal Functions', 2);
INSERT INTO `subject` VALUES (15, 'Quadratic Functions', 2);
INSERT INTO `subject` VALUES (16, 'Exponential Functions', 2);
INSERT INTO `subject` VALUES (17, 'Logarithm Functions', 2);
INSERT INTO `subject` VALUES (18, 'Radian and Arc Length', 3);
INSERT INTO `subject` VALUES (19, 'Definition of Trigonometric Functions', 3);
INSERT INTO `subject` VALUES (20, 'Trigonometric Formulae', 3);
INSERT INTO `subject` VALUES (21, 'Graph of Trigonometric Functions', 3);
INSERT INTO `subject` VALUES (22, 'Trigonometric Equations', 3);
INSERT INTO `subject` VALUES (23, 'Triangle Equations', 3);
INSERT INTO `subject` VALUES (24, 'Definition of Matrices and Terms', 4);
INSERT INTO `subject` VALUES (25, 'Matrix Operations', 4);
INSERT INTO `subject` VALUES (26, 'Determinant', 4);
INSERT INTO `subject` VALUES (27, 'Inverse Matrices', 4);
INSERT INTO `subject` VALUES (28, 'System of Linear Equations', 4);
INSERT INTO `subject` VALUES (29, 'Geometric Definition of Vectors', 5);
INSERT INTO `subject` VALUES (30, 'Components of Vectors', 5);
INSERT INTO `subject` VALUES (31, 'Algebra of Vectors', 5);
INSERT INTO `subject` VALUES (32, 'Magnitude and Unit Vectors', 5);
INSERT INTO `subject` VALUES (33, 'Dot Product', 5);
INSERT INTO `subject` VALUES (34, 'Lines as Vectors', 5);
INSERT INTO `subject` VALUES (35, 'Statistics', 6);
INSERT INTO `subject` VALUES (36, 'Probability', 6);
INSERT INTO `subject` VALUES (37, 'Limits and Convergence', 7);
INSERT INTO `subject` VALUES (38, 'Derivatives', 7);
INSERT INTO `subject` VALUES (39, 'Local Extrema', 7);
INSERT INTO `subject` VALUES (40, 'Anti-Derivatives', 7);
INSERT INTO `subject` VALUES (41, 'Kinematic Problems', 7);
INSERT INTO `subject` VALUES (42, 'Significance of Second Derivatives', 7);
INSERT INTO `subject` VALUES (43, 'Arithmetic Sequences', 8);
INSERT INTO `subject` VALUES (44, 'Geometric Sequences', 8);
INSERT INTO `subject` VALUES (45, 'Arithmetic Series', 8);
INSERT INTO `subject` VALUES (46, 'Geometric Series', 8);
INSERT INTO `subject` VALUES (47, 'Law of Exponents', 9);
INSERT INTO `subject` VALUES (48, 'Law of Logarithms', 9);
INSERT INTO `subject` VALUES (49, 'Concept of Functions', 11);
INSERT INTO `subject` VALUES (50, 'Domain, Range, and Images of Functions', 11);
INSERT INTO `subject` VALUES (51, 'Composite Functions and Identity Functions', 11);
INSERT INTO `subject` VALUES (52, 'Inverse Functions', 11);
INSERT INTO `subject` VALUES (53, 'Asymptotes', 12);
INSERT INTO `subject` VALUES (54, 'Zeros of Functions', 12);
INSERT INTO `subject` VALUES (55, 'Graph of Quadratics', 15);
INSERT INTO `subject` VALUES (56, 'Quadratic Formula', 15);
INSERT INTO `subject` VALUES (57, 'Discriminant', 15);
INSERT INTO `subject` VALUES (58, 'Compound Angle Formulae', 20);
INSERT INTO `subject` VALUES (59, 'Compound Trigonometric Functions Formulae', 20);
INSERT INTO `subject` VALUES (60, 'Double and Triple Angle Formulae', 20);
INSERT INTO `subject` VALUES (61, 'Domains and Ranges of Trigonometric Functions', 21);
INSERT INTO `subject` VALUES (62, 'Periodicity', 21);
INSERT INTO `subject` VALUES (63, 'Trigonometric Graphs in General', 21);
INSERT INTO `subject` VALUES (64, 'Sine Rule', 23);
INSERT INTO `subject` VALUES (65, 'Cosine Rule', 23);
INSERT INTO `subject` VALUES (66, 'Area of Triangles', 23);
INSERT INTO `subject` VALUES (67, 'Algebra of Matrices', 25);
INSERT INTO `subject` VALUES (68, 'Multiplication of Matrices', 25);
INSERT INTO `subject` VALUES (69, 'Identity and Zero Matrices', 25);
INSERT INTO `subject` VALUES (70, 'Dot Product Formulae', 33);
INSERT INTO `subject` VALUES (71, 'Perpendicular and Parallel Vectors', 33);
INSERT INTO `subject` VALUES (72, 'Angle Between Two Vectors', 33);
INSERT INTO `subject` VALUES (73, 'Representation of Lines as Vectors', 34);
INSERT INTO `subject` VALUES (74, 'Coincident and Parallel Lines', 34);
INSERT INTO `subject` VALUES (75, 'Intersections of Lines', 34);
INSERT INTO `subject` VALUES (76, 'Event Space, Sample Space, and Frequency Distribution', 35);
INSERT INTO `subject` VALUES (77, 'Frequency Tables and Diagrams', 35);
INSERT INTO `subject` VALUES (78, 'Basic Statistical Measures', 35);
INSERT INTO `subject` VALUES (79, 'Intro to Probability', 36);
INSERT INTO `subject` VALUES (80, 'Venn Diagrams, Tree Diagrams, and Tables of Outcomes', 36);
INSERT INTO `subject` VALUES (81, 'Inclusion-Exclusion Principles', 36);
INSERT INTO `subject` VALUES (82, 'Conditional Probability', 36);
INSERT INTO `subject` VALUES (83, 'Discrete Random Variables', 36);
INSERT INTO `subject` VALUES (84, 'Binomial and Normal Distribution', 36);
INSERT INTO `subject` VALUES (85, 'Definition of Derivatives', 38);
INSERT INTO `subject` VALUES (86, 'Differentiations of Basic Functions', 38);
INSERT INTO `subject` VALUES (87, 'Differentiation of Complex Functions', 38);
INSERT INTO `subject` VALUES (88, 'Chain Rule', 38);
INSERT INTO `subject` VALUES (89, 'Second Derivative', 38);
INSERT INTO `subject` VALUES (90, 'Indefinite Integrations', 40);
INSERT INTO `subject` VALUES (91, 'Boundary Conditions', 40);
INSERT INTO `subject` VALUES (92, 'Definite Integrations', 40);
INSERT INTO `subject` VALUES (93, 'Areas Under Curves', 40);
INSERT INTO `subject` VALUES (94, 'Volumes of Revolution', 40);
INSERT INTO `subject` VALUES (95, 'Distinction Between Maxima and Minima', 42);
INSERT INTO `subject` VALUES (96, 'Points of Inflexion', 42);
INSERT INTO `subject` VALUES (97, 'Grouped Data', 77);
INSERT INTO `subject` VALUES (98, 'Intervals', 77);
INSERT INTO `subject` VALUES (99, 'Frequency Histograms', 77);
INSERT INTO `subject` VALUES (100, 'Mean, Median, Mode', 78);
INSERT INTO `subject` VALUES (101, 'Quartiles and Percentiles', 78);
INSERT INTO `subject` VALUES (102, 'Variances and Standard Deviations', 78);
INSERT INTO `subject` VALUES (103, 'Differentiations of Polynomials', 86);
INSERT INTO `subject` VALUES (104, 'Differentiations of Trigonometry', 86);
INSERT INTO `subject` VALUES (105, 'Differentiations of Exponentials and Logarithms', 86);

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(30) NOT NULL,
  `password` char(30) default NULL,
  `firstname` text,
  `lastname` text,
  `aboutyou` text,
  `goal` text,
  `nickname` char(20) default NULL,
  `birthday` date default NULL,
  `gender` char(1) default NULL,
  `address` text,
  `email` char(30) default NULL,
  `phone` char(15) default NULL,
  `status` char(1) default NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `firstname` (`firstname`,`lastname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES (1, 'Soravis', '1234', NULL, NULL, 'MPower rocks!!!', 'I really hope people can use this site for real!!! ', 'Man, Mike', '1992-04-23', 'm', NULL, 'soravis@stanford.edu', '6505495351', 's');
INSERT INTO `user` VALUES (2, 'Potcharapol', '123456', NULL, NULL, 'Yeah!!!', 'Finish this project', 'Neung, Potchy', '1991-10-24', 'm', '43/1-2 Chalermkhet 2 Road, Pomprab Bangkok, Thailand 10100', 'neungs1@stanford.edu', '6506446708', 't');
INSERT INTO `user` VALUES (7, 'Soravis', '1234', '', '', NULL, NULL, NULL, NULL, '', NULL, '', NULL, '');
INSERT INTO `user` VALUES (6, 'Sdasd', 'adsdas', '', '', NULL, NULL, NULL, NULL, '', NULL, '', NULL, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `video`
-- 

CREATE TABLE `video` (
  `id` int(11) NOT NULL auto_increment,
  `title` text,
  `subject` text,
  `link` text,
  `description` text,
  `creator` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `title` (`title`,`subject`,`link`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `video`
-- 

INSERT INTO `video` VALUES (1, 'Basic Trigonometry', 'Trigonometry', 'http://www.youtube.com/watch?v=F21S9Wpi0y8', 'Basic trigonometry sine, cosine, and tangent', 2, '2013-06-11 00:00:00');
INSERT INTO `video` VALUES (2, 'Basic Trigonometry II', 'Trigonometry', 'http://www.youtube.com/watch?v=G-T_6hCdMQc', 'SOH, CAH, TOA', 2, '2013-06-02 04:08:00');
INSERT INTO `video` VALUES (3, 'Radians and degrees', 'Geometry', 'http://www.youtube.com/watch?v=9zspW8u6kQM', 'What a radian is. Converting radians to degrees and vice versa.', 2, '2013-06-01 00:15:00');
INSERT INTO `video` VALUES (4, 'Unit Circle Definition of Trig Functions', 'Unit Circle', 'http://www.youtube.com/watch?v=ZffZvSH285c', 'Using the unit circle to define the sine, cosine, and tangent functions', 2, '2013-06-01 00:00:00');
INSERT INTO `video` VALUES (5, 'Graphs of trig functions', 'Trigonometry', 'http://www.youtube.com/watch?v=QmxMPPkZpME', 'Exploring Graph!', 2, '2013-06-03 15:00:00');
INSERT INTO `video` VALUES (6, 'The Pythagorean Theorem', 'Trigonometry', 'http://www.youtube.com/watch?v=AA6RfgP-AHU', 'Introduction', 2, '2013-06-01 12:12:00');
INSERT INTO `video` VALUES (7, '45-45-90 triangles', 'Trigonometry', 'http://www.youtube.com/watch?v=tSHitjFIjd8', '45-45-90 introduction and ratio', 2, '2013-05-16 00:00:00');
INSERT INTO `video` VALUES (8, 'Area of a cycle', 'Geometry', 'http://www.youtube.com/watch?v=tCrDyJsSFok', 'Area of a circle, its radius and diameter', 3, '2013-05-09 00:00:00');
INSERT INTO `video` VALUES (9, 'Cylinder volume and surface area', 'Geometry', 'http://www.youtube.com/watch?v=gL3HxBQyeg0', 'finding the volume and a surface area of a cylinder', 3, '2013-05-23 08:17:00');
INSERT INTO `video` VALUES (10, 'Circle II', 'Trigonometry', 'http://www.youtube.com/watch?v=eBAsK9jB91I', 'circle II', 2, '2013-06-07 06:37:55');
