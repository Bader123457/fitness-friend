-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 04:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness_bro`
--

-- --------------------------------------------------------

--
-- Table structure for table `compendium_of_physical_activities`
--

CREATE TABLE `compendium_of_physical_activities` (
  `activity_code` int(11) NOT NULL,
  `category` text NOT NULL,
  `met_value` double(2,1) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compendium_of_physical_activities`
--

INSERT INTO `compendium_of_physical_activities` (`activity_code`, `category`, `met_value`, `description`) VALUES
(1003, 'Bicycling', 9.9, 'Bicycling, mountain, uphill, vigorous'),
(1004, 'Bicycling', 9.9, 'Bicycling, mountain, competitive racing'),
(1008, 'Bicycling', 8.5, 'Bicycling, BMX'),
(1009, 'Bicycling', 8.5, 'Bicycling, mountain, general'),
(1010, 'Bicycling', 4.0, 'Bicycling, <10 mph, leisure, to work or for pleasure (Taylor Code 115)'),
(1011, 'Bicycling', 6.8, 'Bicycling, to/from work, self selected pace'),
(1013, 'Bicycling', 5.8, 'Bicycling, on dirt or farm road, moderate pace'),
(1014, 'Bicycling', 7.0, 'Bicycling, general'),
(1015, 'Bicycling', 4.3, 'Bicycling, self-selected easy pace'),
(1016, 'Bicycling', 7.0, 'Bicycling, self-selected moderate pace'),
(1017, 'Bicycling', 9.0, 'Bicycling, self-selected vigorous pace'),
(1018, 'Bicycling', 3.5, 'Bicycling, leisure 5.5 mph'),
(1019, 'Bicycling', 5.8, 'Bicycling, leisure, 9.4 mph'),
(1020, 'Bicycling', 6.8, 'Bicycling, 10-11.9 mph, leisure, slow, light effort'),
(1030, 'Bicycling', 8.0, 'Bicycling, 12-13.9 mph, leisure, moderate effort'),
(1040, 'Bicycling', 9.9, 'Bicycling, 14-15.9 mph, racing or leisure, fast, vigorous effort'),
(1050, 'Bicycling', 9.9, 'Bicycling, 16-19 mph, racing/not drafting or >19 mph drafting, very fast, racing general'),
(1060, 'Bicycling', 9.9, 'Bicycling, >20 mph, racing, not drafting'),
(1065, 'Bicycling', 8.5, 'Bicycling, 12 mph, seated, hands on brake hoods or bar drops, 80 rpm'),
(1066, 'Bicycling', 9.0, 'Bicycling, 12 mph, standing, hands on brake hoods, 60 rpm'),
(1070, 'Bicycling', 5.0, 'Unicycling'),
(1080, 'Bicycling', 6.8, 'E-bike (electrically assisted) without electronic support'),
(1084, 'Bicycling', 6.0, 'E-bike (electrically assisted) with light electronic support'),
(1088, 'Bicycling', 4.0, 'E-bike (electrically assisted) with high electronic support'),
(1200, 'Bicycling', 6.8, 'Bicycling, stationary, general'),
(1210, 'Bicycling', 3.5, 'Bicycling, stationary, 25-30 watts, very light to light effort'),
(1214, 'Bicycling', 4.0, 'Bicycling, stationary, 50 watts, light effort'),
(1216, 'Bicycling', 5.0, 'Bicycling, stationary, 60 watts, light to moderate effort'),
(1218, 'Bicycling', 5.8, 'Bicycling, stationary, 70-80 watts'),
(1220, 'Bicycling', 6.0, 'Bicycling, stationary, 90-100 watts,  moderate to vigorous'),
(1224, 'Bicycling', 6.8, 'Bicycling, stationary, 101-125 watts'),
(1228, 'Bicycling', 8.0, 'Bicycling, stationary, 126-150 watts'),
(1232, 'Bicycling', 9.9, 'Bicycling, stationary, 151-199 watts'),
(1236, 'Bicycling', 9.9, 'Bicycling, stationary, 200-229 watts, vigorous'),
(1240, 'Bicycling', 9.9, 'Bicycling, stationary, 230-250 watts, very vigorous'),
(1244, 'Bicycling', 9.9, 'Bicycling, stationary, 270-305 watts, very vigorous'),
(1248, 'Bicycling', 9.9, 'Bicycling, stationary, >325 watts, very vigorous'),
(1252, 'Bicycling', 5.5, 'Bicycling, concentric only, 100 W'),
(1254, 'Bicycling', 9.9, 'Bicycling, concentric only, 200 W'),
(1262, 'Bicycling', 2.3, 'Bicycling, eccentric only, 100 to 149 W'),
(1264, 'Bicycling', 4.0, 'Bicycling, eccentric only, 200 W2024 Adult Compendium of Physical Activities'),
(1270, 'Bicycling', 9.0, 'Bicycling, stationary, RPM/Spin bike class'),
(1290, 'Bicycling', 8.8, 'Bicycling, interactive virtual cycling, indoor cycle ergometer'),
(1305, 'Bicycling', 8.8, 'Bicycling, high intensity interval training'),
(3005, 'Dancing', 6.0, 'Afro-Cuban salsa (Cuban cha-cha-cha, mambo, Afro rumba, contratiempo son steps, orisha/santo movements)'),
(3010, 'Dancing', 5.0, 'Ballet, modern, or jazz general, rehearsal or class'),
(3011, 'Dancing', 6.3, 'Ballet exercises (plie, tendus, jetes, rond de Jambes, fondus, grand battement, grand adage, sautes, temp Leve\'s)'),
(3012, 'Dancing', 6.8, 'Ballet, modern, or jazz, performance, vigorous effort'),
(3014, 'Dancing', 4.8, 'Tap'),
(3025, 'Dancing', 4.5, 'Ethnic or cultural dancing (e.g. Greek, Middle Eastern, hula, salsa, merengue, bamba y plena,  flamenco, belly, and swing)'),
(3028, 'Dancing', 5.5, 'Chinese square dance, Ballet & Tibetan dance'),
(3029, 'Dancing', 7.3, 'Chinese square dance, aerobic dance'),
(3030, 'Dancing', 5.5, 'Ballroom dancing, fast (Taylor Code 125)'),
(3031, 'Dancing', 9.8, 'Nightclub or folk dancing, vigorous effort (e.g., nightclub, disco, folk, line dancing, Irish step dancing, polka, contra)'),
(3033, 'Dancing', 5.0, 'Folk dancing, moderate effort'),
(3038, 'Dancing', 9.9, 'Ballroom dancing, competitive, general'),
(3040, 'Dancing', 3.0, 'Ballroom, slow, examples: waltz, foxtrot, slow dancing, samba tango, rumba, 19th century dance, mambo, cha cha'),
(3042, 'Dancing', 6.0, 'Ballroom Dance, Recreational (Waltz, Foxtrot, Cha-cha, Swing)'),
(3050, 'Dancing', 5.5, 'Anishinaabe Jingle dancing, brisk pace, other traditional American Indian dancing performed by women, moderate effort'),
(3070, 'Dancing', 3.8, 'Contemporary dancing, general'),
(3072, 'Dancing', 4.3, 'Contemporary dancing, nightclub'),
(3075, 'Dancing', 8.5, 'Flamenco dance'),
(3078, 'Dancing', 4.5, 'Jazz dancing, general'),
(3080, 'Dancing', 9.9, 'Musical Theater, Singing/dancing'),
(3085, 'Dancing', 5.8, 'Polynesian dance, Hawaiian hula slow, Maori haka, Tongan'),
(3086, 'Dancing', 7.0, 'Polynesian dance, Hawaiian hula fast, Samoan sasa, Fijian style fast, Filipino Tinikling'),
(3087, 'Dancing', 8.8, 'Polynesian dance, Samoan slap, Tahitian'),
(3090, 'Dancing', 4.8, 'Salsa Dancing, with partner'),
(3091, 'Dancing', 6.3, 'Salsa dancing, to a video'),
(3093, 'Dancing', 5.5, 'Square Dancing, American Western, country'),
(7009, 'Inactivity', 1.0, 'Lying quietly and watching television'),
(7011, 'Inactivity', 1.0, 'Lying quietly, doing nothing, lying in bed awake, listening to music (not talking or reading)'),
(7020, 'Inactivity', 1.0, 'Sit, watch television'),
(7021, 'Inactivity', 1.0, 'Sitting quietly, general'),
(7022, 'Inactivity', 1.5, 'Sitting quietly, fidgeting, general, fidgeting hands'),
(7023, 'Inactivity', 1.8, 'Sitting, fidget feet'),
(7024, 'Inactivity', 1.3, 'Sitting smoking'),
(7025, 'Inactivity', 1.5, 'Sitting, listening to music (not talking or reading) or watching a movie in a theater'),
(7026, 'Inactivity', 1.3, 'Sitting at a desk, resting head in hands'),
(7030, 'Inactivity', 1.0, 'Sleeping'),
(7040, 'Inactivity', 1.3, 'Standing quietly (standing in a line)'),
(7041, 'Inactivity', 1.5, 'Standing (fidgeting)'),
(7045, 'Inactivity', 1.3, 'Standing watching television'),
(7050, 'Inactivity', 1.5, 'Reclining, writing'),
(7060, 'Inactivity', 1.3, 'Reclining, talking or talking on phone'),
(7070, 'Inactivity', 1.3, 'Reclining, reading'),
(7075, 'Inactivity', 1.0, 'Meditating'),
(9000, 'Miscellaneous', 1.3, 'Board game playing, sitting'),
(9005, 'Miscellaneous', 2.5, 'Casino gambling, standing'),
(9010, 'Miscellaneous', 1.5, 'Card playing, sitting'),
(9013, 'Miscellaneous', 1.5, 'Chess game, sitting'),
(9015, 'Miscellaneous', 1.5, 'Copying or filing documents, standing'),
(9020, 'Miscellaneous', 1.8, 'Drawing, writing, painting, standing'),
(9025, 'Miscellaneous', 1.0, 'Laughter, sitting'),
(9030, 'Miscellaneous', 1.0, 'Sitting: reading, book, newspaper, magazine'),
(9034, 'Miscellaneous', 1.8, 'sitting, typing or reading on a balance chair/stability ball'),
(9036, 'Miscellaneous', 2.0, 'watching tv, stepping during commercial breaks'),
(9040, 'Miscellaneous', 1.3, 'Sitting: writing, desk work, typing'),
(9050, 'Miscellaneous', 1.3, 'Standing:  talking in person, on the phone, computer, text messaging, writing'),
(9055, 'Miscellaneous', 1.3, 'Sitting: talking in person, on the phone, computer, or  text messaging, light effort'),
(9060, 'Miscellaneous', 1.5, 'Sitting - studying, general, including reading and/or writing, light effort'),
(9065, 'Miscellaneous', 1.8, 'Sitting - in class, general, including note-taking or class discussion'),
(9070, 'Miscellaneous', 1.0, 'Standing - reading'),
(9071, 'Miscellaneous', 2.5, 'Standing: miscellaneous'),
(9075, 'Miscellaneous', 1.8, 'Sitting: arts and crafts, carving wood, weaving, spinning wool, light effort'),
(9080, 'Miscellaneous', 3.0, 'Sitting: arts and crafts, carving wood, weaving, spinning wool, moderate effort'),
(9085, 'Miscellaneous', 2.5, 'Standing: arts and crafts, sand painting, carving, weaving, light effort'),
(9090, 'Miscellaneous', 3.3, 'Standing - arts and crafts, sand painting, carving, weaving, moderate effort'),
(9095, 'Miscellaneous', 3.5, 'Standing - arts and crafts, sand painting, carving, weaving, vigorous effort'),
(9100, 'Miscellaneous', 1.5, 'Retreat/family reunion activities involving sitting, relaxing, talking, eating'),
(9101, 'Miscellaneous', 2.5, 'Retreat/family reunion activities involving playing games with children'),
(9105, 'Miscellaneous', 2.0, 'Touring/traveling/vacation involving  riding in vehicle'),
(9106, 'Miscellaneous', 3.5, 'Touring/traveling/vacation involving walking'),
(9110, 'Miscellaneous', 2.5, 'Camping involving standing, walking, sitting, light-to-moderate effort'),
(9115, 'Miscellaneous', 1.5, 'Sitting at a sporting event, spectator'),
(11000, 'Occupation', 2.0, 'Active workstation, Pedal desk, balance chair/ball, General, light effort'),
(11001, 'Occupation', 3.5, 'Active workstation, Pedal desk (40 watts)'),
(11002, 'Occupation', 5.3, 'Active workstation, Pedal desk (80 watts)'),
(11003, 'Occupation', 2.0, 'Active workstation, treadmill desk, walking slowly 1.0 mph or less'),
(11004, 'Occupation', 2.8, 'Active workstation, treadmill desk, walking  1.0 - 2.0 mph'),
(11006, 'Occupation', 3.0, 'Airline flight attendant'),
(11008, 'Occupation', 4.8, 'Apple Harvesting'),
(11010, 'Occupation', 4.0, 'Bakery, general, moderate effort'),
(11015, 'Occupation', 2.0, 'Bakery, light effort'),
(11020, 'Occupation', 2.3, 'Bookbinding'),
(11030, 'Occupation', 6.0, 'Building road, driving heavy machinery'),
(11035, 'Occupation', 2.0, 'Building road, directing traffic, standing'),
(11038, 'Occupation', 2.5, 'Carpentry, general, light effort'),
(11040, 'Occupation', 4.3, 'Carpentry, general, moderate effort'),
(11042, 'Occupation', 7.0, 'Carpentry, general, heavy or vigorous effort'),
(11050, 'Occupation', 8.0, 'Carrying heavy loads (e.g., bricks, tools)'),
(11060, 'Occupation', 8.0, 'Carrying moderate loads up stairs, moving  boxes, 25-49 lbs'),
(11070, 'Occupation', 4.0, 'Chambermaid, hotel housekeeper, making bed,  cleaning bathroom, pushing cart'),
(11072, 'Occupation', 4.3, 'Cleaning, vacuuming commercial space'),
(11080, 'Occupation', 5.3, 'Coal mining, drilling coal, rock'),
(11090, 'Occupation', 5.0, 'Coal mining, erecting supports'),
(11100, 'Occupation', 5.5, 'Coal mining, general'),
(11110, 'Occupation', 6.3, 'Coal mining, shoveling coal, by hand'),
(11115, 'Occupation', 2.5, 'Cook, chef'),
(11120, 'Occupation', 4.0, 'Construction, outside, remodeling, new  structures (e.g., roof repair, miscellaneous)'),
(11124, 'Occupation', 2.3, 'Construction, rebar, bar bending/fixing'),
(11125, 'Occupation', 2.3, 'Custodial work, light effort (e.g., cleaning sink  and toilet, dusting, vacuuming, light cleaning)'),
(11130, 'Occupation', 3.3, 'Electrical work (e.g., hook up wire, tapping splicing); plumbing moved to11516'),
(11135, 'Occupation', 1.8, 'Engineer (e.g., mechanical or electrical)'),
(11145, 'Occupation', 7.8, 'Farming, vigorous effort (e.g., baling hay,  cleaning barn), includes former code 11200'),
(11147, 'Occupation', 2.0, 'Farming, light effort, (e.g., cleaning animal  sheds, preparing animal feed)'),
(11170, 'Occupation', 2.8, 'Farming, driving tasks (e.g., driving tractor or  harvester)'),
(11180, 'Occupation', 3.5, 'Farming, feeding small animals'),
(11190, 'Occupation', 4.3, 'Farming, feeding cattle, horses'),
(11191, 'Occupation', 4.3, 'Farming, hauling water for animals, fetching  water from well or stream'),
(11195, 'Occupation', 3.8, 'Farming, rice, planting, grain milling activities'),
(11210, 'Occupation', 3.5, 'Farming, milking by hand, cleaning pails,  moderate effort'),
(11220, 'Occupation', 1.3, 'Farming, milking by machine, light effort'),
(11222, 'Occupation', 3.0, 'Farming, milking Cows, full milking process, modern milking parlor with milking machines'),
(11240, 'Occupation', 8.0, 'Fire fighter, general'),
(11244, 'Occupation', 6.8, 'Fire fighter, rescue victim, automobile  accident, using pike pole'),
(11245, 'Occupation', 8.0, 'Fire fighter, raising and climbing ladder with  full gear, simulated fire suppression'),
(11246, 'Occupation', 9.0, 'Fire fighter, hauling hoses on ground,  carrying/hoisting equipment, breaking down  walls etc., wearing full gear'),
(11247, 'Occupation', 3.5, 'Fishing, commercial, light effort'),
(11248, 'Occupation', 5.0, 'Fishing, commercial, moderate effort'),
(11250, 'Occupation', 9.9, 'Forestry, ax chopping, very fast, 1.25 kg axe,  51 blows/min, extremely vigorous effort'),
(11260, 'Occupation', 5.0, 'Forestry, ax chopping, slow, 1.25 kg axe, 19  blows/min, moderate effort'),
(11262, 'Occupation', 8.0, 'Forestry, ax chopping, fast, 1.25 kg axe, 35  blows/min, vigorous effort'),
(11264, 'Occupation', 5.0, 'Forestry, moderate effort (e.g., sawing wood  with power saw, weeding, hoeing)'),
(11370, 'Occupation', 4.8, 'Furriery'),
(11375, 'Occupation', 3.8, 'Garbage collector, walking, dumping bins into truck, street cleaning'),
(11378, 'Occupation', 1.8, 'Hairstylist (e.g., plaiting hair, manicure, make up artist)'),
(11380, 'Occupation', 7.3, 'Horse grooming, including feeding, cleaning  stalls, bathing, brushing, clipping, longeing and  exercising horses.'),
(11381, 'Occupation', 4.3, 'Horse, feeding, watering, cleaning stalls, implied walking and lifting loads'),
(11383, 'Occupation', 4.5, 'Horseback riding, working, cutting cows'),
(11390, 'Occupation', 7.8, 'Horse racing, galloping, cantor'),
(11400, 'Occupation', 6.3, 'Horse racing, Jockey, trotting'),
(11410, 'Occupation', 2.3, 'Horse racing, Jockey, walking'),
(11413, 'Occupation', 3.0, 'Kitchen maid'),
(11415, 'Occupation', 4.0, 'Lawn keeper, yardwork, general'),
(11416, 'Occupation', 3.0, 'Lawn keeper, weeding, gas powered'),
(11418, 'Occupation', 3.3, 'Laundry worker'),
(11420, 'Occupation', 3.0, 'Locksmith'),
(11430, 'Occupation', 3.0, 'Machine tooling (e.g., machining, working  sheet metal, machine fitter, operating lathe,  welding) light-to-moderate effort'),
(11450, 'Occupation', 5.0, 'Machine tooling, operating punch press,  moderate effort'),
(11472, 'Occupation', 1.8, 'Manager, property'),
(11475, 'Occupation', 2.8, 'Manual or unskilled labor, general, light effort'),
(11476, 'Occupation', 4.5, 'Manual or unskilled labor, general, moderate effort'),
(11477, 'Occupation', 6.5, 'Manual or unskilled labor, general, vigorous effort'),
(11480, 'Occupation', 4.3, 'Masonary, concrete, moderate effort'),
(11482, 'Occupation', 2.5, 'Masonry, concrete, light effort'),
(11485, 'Occupation', 5.5, 'Massage therapist, standing'),
(11486, 'Occupation', 2.3, 'Mail carrier, walking to deliver mail'),
(11487, 'Occupation', 1.5, 'Mail delivery, motorbike'),
(11488, 'Occupation', 3.5, 'Mail delivery, Electronically Assisted Bicycle'),
(11490, 'Occupation', 7.5, 'Moving, carrying or pushing heavy objects, 75  lbs or more, only active time (e.g., desks,  moving van work)'),
(11493, 'Occupation', 8.5, 'Mining, general services, drilling, mining support jobs (mechanical, welding, pipe installation, general construction)'),
(11495, 'Occupation', 9.9, 'Skindiving or SCUBA diving as a frogman,  Navy Seal'),
(11500, 'Occupation', 2.5, 'Operating heavy duty equipment, automated,  not driving'),
(11510, 'Occupation', 3.5, 'Orange grove work, picking fruit'),
(11514, 'Occupation', 3.3, 'Painting, house, furniture, moderate effort'),
(11516, 'Occupation', 3.0, 'Plumbing activities'),
(11520, 'Occupation', 2.0, 'Printing, paper industry worker, standing'),
(11524, 'Occupation', 3.8, 'Police Officer, Walking'),
(11525, 'Occupation', 2.5, 'Police, directing traffic, standing'),
(11526, 'Occupation', 2.0, 'Police, driving a squad car, sitting'),
(11527, 'Occupation', 1.3, 'Police, riding in a squad car, sitting'),
(11528, 'Occupation', 4.0, 'Police, making an arrest, standing'),
(11529, 'Occupation', 9.0, 'Counter terrorism maneuvers, clearing building'),
(11530, 'Occupation', 2.0, 'Shoe repair, general'),
(11540, 'Occupation', 7.3, 'Shoveling, digging ditches'),
(11550, 'Occupation', 8.8, 'Shoveling, more than 16 lbs/minute, deep  digging, vigorous effort'),
(11560, 'Occupation', 5.0, 'Shoveling, less than 10 lbs/minute, moderate  effort'),
(11570, 'Occupation', 6.5, 'Shoveling, 10 to 15 lbs/minute, vigorous effort'),
(11580, 'Occupation', 1.5, 'Sitting tasks, light effort (e.g., office work,  chemistry lab work, light  assembly repair, watch repair, reading, desk  work)'),
(11582, 'Occupation', 1.3, 'Sitting, computer work'),
(11583, 'Occupation', 1.3, 'Standing workstation, typing, computer work'),
(11585, 'Occupation', 1.3, 'Sitting meetings, light effort, general, and/or with talking involved (e.g., eating at a business meeting)'),
(11590, 'Occupation', 2.5, 'Sitting tasks, moderate effort (e.g. pushing  heavy levers, riding mower/forklift, crane  operation)'),
(11593, 'Occupation', 2.8, 'Sitting, teaching stretching or yoga, or light  effort exercise classes'),
(11615, 'Occupation', 4.5, 'Standing, moderate effort, lifting items  continuously, 10 – 20 lbs, with limited walking  or resting'),
(11620, 'Occupation', 3.8, 'Standing, moderate effort, intermittent lifting  50 lbs, hitch or twisting ropes'),
(11630, 'Occupation', 4.5, 'Standing, moderate/heavy tasks (e.g., lifting  more than 50 lbs, masonry, painting, paper  hanging)'),
(11650, 'Occupation', 2.3, 'Patient care, healthcare activites'),
(11660, 'Occupation', 3.5, 'Patient care, room cleaning/preperation'),
(11708, 'Occupation', 5.3, 'Steel mill, moderate effort (e.g., fettling,  forging, tipping molds)'),
(11710, 'Occupation', 8.3, 'Steel mill, vigorous effort (e.g., hand rolling,  merchant mill rolling, removing slag, tending  furnace)'),
(11720, 'Occupation', 2.3, 'Tailoring, cutting fabric'),
(11730, 'Occupation', 2.5, 'Tailoring, general'),
(11740, 'Occupation', 1.8, 'Tailoring, hand sewing'),
(11750, 'Occupation', 2.5, 'Tailoring, machine sewing'),
(11760, 'Occupation', 3.5, 'Tailoring, pressing'),
(11763, 'Occupation', 2.0, 'Tailoring, weaving, light effort (e.g., finishing operations, washing, dyeing, inspecting cloth, counting yards, paperwork)'),
(11766, 'Occupation', 6.5, 'Truck driving, loading and unloading truck,  tying down load, standing, walking and  carrying heavy loads'),
(11767, 'Occupation', 2.0, 'Truck driving, delivery truck, taxi, shuttlebus,  school bus'),
(11770, 'Occupation', 1.3, 'Typing, electric, manual or computer'),
(11780, 'Occupation', 6.3, 'Using heavy power tools such as pneumatic  tools (e.g., jackhammers, drills, etc.)'),
(11790, 'Occupation', 7.8, 'Using heavy tools (not power) such as shovel,  pick, tunnel bar, spade'),
(11791, 'Occupation', 2.0, 'Walking on job, less than 2.0 mph, very slow  speed, in office or lab area'),
(11792, 'Occupation', 3.8, 'Walking on job, 2.8 to 3.4 mph, in office, moderate  speed, not carrying anything'),
(11793, 'Occupation', 4.8, 'Walking on job, 3.5 to 3.9 mph, in office, brisk speed,  not carrying anything'),
(11795, 'Occupation', 3.5, 'Walking on job, 2.5 mph, slow speed, carrying  light objects less than 25 lbs'),
(11796, 'Occupation', 3.0, 'Walking, gathering things at work, ready to  leave'),
(11797, 'Occupation', 3.8, 'Walking, 2.5 mph, slow speed, carrying heavy  objects more than 25 lbs'),
(11800, 'Occupation', 4.5, 'Walking, 3.0 mph, moderately and carrying  light objects less than 25 lbs'),
(11805, 'Occupation', 3.8, 'Walking, pushing a wheelchair'),
(11810, 'Occupation', 4.5, 'Walking, 3.5 mph, briskly and carrying objects  less than 25 lbs'),
(11820, 'Occupation', 4.0, 'Walking or walk downstairs or standing,  carrying objects about 25 to 49 lbs'),
(11830, 'Occupation', 5.5, 'Walking or walk downstairs or standing,  carrying objects about 50 to 74 lbs'),
(11840, 'Occupation', 7.0, 'Walking or walk downstairs or standing,  carrying objects about 75 to 99 lbs'),
(11850, 'Occupation', 7.3, 'Walking or walk downstairs or standing,  carrying objects about 100 lbs or more'),
(11860, 'Occupation', 2.3, 'Warehouse/Shipping Center, Loading/Unloading boxes'),
(11862, 'Occupation', 4.3, 'Warehouse/Shipping Center, Moving boxes (~5kg)'),
(11870, 'Occupation', 3.0, 'Working in scene shop, theater actor, backstage  employee'),
(11880, 'Occupation', 3.5, 'Soldiers, military marching, unloaded 1.5-2.5 mph'),
(11882, 'Occupation', 4.0, 'Soldiers, military marching, 1.5-2.5 mph, 10 to 30 kg load'),
(11884, 'Occupation', 5.0, 'Airborne Shuffle, 2.5 to 3.5 mph, 20-30 kg load'),
(11886, 'Occupation', 6.3, 'Soldiers, military loaded marching, varying terrain, 25-40 kg load'),
(11887, 'Occupation', 6.0, 'Soldiers, walking, 2.8 mph, 5% grade, up to 21.5 kg load'),
(11888, 'Occupation', 8.5, 'Soldiers, walking,  2.8 mph, 10% grade, up to 21.5 kg load'),
(11889, 'Occupation', 9.9, 'Soldiers, walking,  2.8 mph, 15% grade, up to 21.5 kg load'),
(11892, 'Occupation', 6.0, 'Military activities, arterial field preparation, digging defensive positions'),
(12010, 'Running', 6.0, 'Jog/walk combination (jogging component of less than 10 minutes) (Taylor Code 180)'),
(12020, 'Running', 7.5, 'Jogging, general, self-selected pace'),
(12025, 'Running', 4.8, 'Jogging, in place'),
(12026, 'Running', 3.3, 'Jogging 2.6 to 3.7 mph'),
(12027, 'Running', 4.5, 'Jogging on a mini-tramp'),
(12028, 'Running', 6.5, 'Running, 4 to 4.2 mph (13 min/mile)'),
(12029, 'Running', 7.8, 'Running 4.3 to 4.8 mph'),
(12030, 'Running', 8.5, 'Running, 5.0 to 5.2 mph (12 min/mile)'),
(12045, 'Running', 9.0, 'Running, 5.5 -5.8 mph'),
(12050, 'Running', 9.3, 'Running, 6-6.3 mph (10 min/mile)'),
(12060, 'Running', 9.9, 'Running, 6.7 mph (9 min/mile)'),
(12070, 'Running', 9.9, 'Running, 7 mph (8.5 min/mile)'),
(12080, 'Running', 9.9, 'Running, 7.5 mph (8 min/mile)'),
(12090, 'Running', 9.9, 'Running, 8 mph (7.5 min/mile)'),
(12100, 'Running', 9.9, 'Running, 8.6 mph (7 min/mile)'),
(12110, 'Running', 9.9, 'Running, 9 mph (6.5 min/mile)'),
(12115, 'Running', 9.9, 'Running, 9.3 to 9.6 mph'),
(12120, 'Running', 9.9, 'Running, 10 mph (6 min/mile)'),
(12130, 'Running', 9.9, 'Running, 11 mph (5.5 min/mile)'),
(12132, 'Running', 9.9, 'Running, 12 mph (5.0 min/mile)'),
(12134, 'Running', 9.9, 'Running, 13 mph (4.6 min/mile)'),
(12135, 'Running', 9.9, 'Running, 14 mph (4.3 min/mile)'),
(12140, 'Running', 9.3, 'Running, cross country'),
(12145, 'Running', 9.9, 'Running, self-selected pace'),
(12150, 'Running', 8.0, 'Running (Taylor Code 200)'),
(12170, 'Running', 9.9, 'Running, stairs, up'),
(12180, 'Running', 9.9, 'Running, on a track, team practice'),
(12184, 'Running', 9.9, 'Running, on track, 500-1500m, competitive'),
(12186, 'Running', 9.9, 'Running, on track, 2000-3000m, competitive'),
(12190, 'Running', 8.0, 'Running, training, pushing a wheelchair or baby carrier'),
(12200, 'Running', 9.9, 'Running, marathon'),
(12255, 'Running', 9.9, 'Running uphill, 4.5mph, 5% incline'),
(12260, 'Running', 9.9, 'Running uphill, 6.0 mph, 5% incline'),
(12265, 'Running', 9.9, 'Running uphill, 7.0 mph, 5% incline'),
(12325, 'Running', 9.9, 'Running uphill, 5.0 to 5.9 mph, 15% incline'),
(12335, 'Running', 8.8, 'Running uphill, 0.6 to 0.79 mph, 30% incline'),
(12337, 'Running', 9.9, 'Running uphill, 0.8 to 0.99 mph, 30% incline'),
(12339, 'Running', 9.9, 'Running uphill, 1.0 to 1.19 mph, 30% incline'),
(12341, 'Running', 9.9, 'Running uphill, 1.2 to 1.39 mph, 30-40% incline'),
(12343, 'Running', 9.9, 'Running uphill, 1.4 to 1.59 mph, 30% incline'),
(12345, 'Running', 9.9, 'Running uphill, >1.6mph, 10-30% incline'),
(12350, 'Running', 9.9, 'Running, hilly terrain, ±100m change in elevation'),
(12352, 'Running', 5.8, 'Running downhill, 5.0 to 5.9 mph, -10% to -15%'),
(12353, 'Running', 7.5, 'Running downhill, 6.0 to 6.9 mph, -10% to -15%'),
(12355, 'Running', 9.0, 'Running downhill, 7.0 to 8.9 mph, -10% to -15%'),
(12358, 'Running', 9.3, 'Running downhill, 6.0 to 7.9 mph, -3% to -9%'),
(12361, 'Running', 9.9, 'Running downhill, 8.0 to 10.5 mph, -3% to -9%'),
(12405, 'Running', 5.3, 'Running/jogging, curved treadmill, 3.0 to 3.9 mph'),
(12408, 'Running', 6.5, 'Running/jogging, curved treadmill, 4.0 to 4.9 mph'),
(12410, 'Running', 9.9, 'Running curved treadmill, 5.0 to 5.9 mph'),
(12412, 'Running', 9.9, 'Running curved treadmill, 7.0 to 7.9 mph'),
(12414, 'Running', 9.9, 'Running curved treadmill, 8.0 to 8.9 mph'),
(12416, 'Running', 9.9, 'Running curved treadmill, 9.0 to 9.9 mph'),
(12508, 'Running', 8.5, 'Running, 5.0 - 5.9 mph, 1.0 to 3.0 kg backpack'),
(12510, 'Running', 9.5, 'Running, 6.0 - 6.9 mph, 1.0 to 3.0 kg backpack'),
(12512, 'Running', 9.8, 'Running, 7.0 - 7.9 mph, 1.0 to 3.0 kg backpack'),
(12514, 'Running', 9.9, 'Running, 8.0 - 8.9 mph, 1.0 to 3.0 kg backpack'),
(12555, 'Running', 7.8, 'Running, barefoot, 3.5-5.9 mph'),
(12560, 'Running', 9.9, 'Running, barefoot, 6.0-7.9 mph'),
(12565, 'Running', 9.9, 'Running, barefoot, 8.0-8.9 mph'),
(12585, 'Running', 8.0, 'Running, jogging stroller, indoors, 5 mph'),
(12588, 'Running', 9.0, 'Running, jogging stroller, indoors, 6 mph'),
(12593, 'Running', 9.9, 'Running, jogging stroller, outdoors, 5 mph'),
(12595, 'Running', 9.9, 'Running, jogging stroller, outdoors, 6 mph'),
(12600, 'Running', 9.9, 'Skipping, 5.5-6.0 mph'),
(12620, 'Running', 9.9, 'Triathlon, Running'),
(15000, 'Sports', 5.5, 'Alaska Native Games, Eskimo Olympics, general'),
(15010, 'Sports', 4.3, 'Archery (non-hunting)'),
(15020, 'Sports', 7.0, 'Badminton, competitive (Taylor Code 450)'),
(15025, 'Sports', 9.0, 'Badminton, competitive, match play'),
(15030, 'Sports', 5.5, 'Badminton, social singles and doubles, general'),
(15040, 'Sports', 8.0, 'Basketball, game (Taylor Code 490)'),
(15050, 'Sports', 6.0, 'Basketball, non-game, general (Taylor Code 480)'),
(15055, 'Sports', 7.5, 'Basketball, general'),
(15060, 'Sports', 7.0, 'Basketball, officiating (Taylor Code 500)'),
(15062, 'Sports', 5.8, 'Basketball, officiating'),
(15070, 'Sports', 5.0, 'Basketball, shooting baskets'),
(15072, 'Sports', 9.3, 'Basketball, drills, practice'),
(15080, 'Sports', 2.5, 'Billiards'),
(15090, 'Sports', 3.0, 'Bowling (Taylor Code 390)'),
(15092, 'Sports', 3.8, 'Bowling, indoor, bowling alley'),
(15100, 'Sports', 9.9, 'Boxing, in ring, general'),
(15110, 'Sports', 5.8, 'Boxing, punching bag'),
(15113, 'Sports', 7.0, 'Boxing, punching bag, 60 b/min'),
(15115, 'Sports', 8.5, 'Boxing, punching bag, 120 b/min'),
(15118, 'Sports', 9.9, 'Boxing, punching bag, 180 b/min'),
(15120, 'Sports', 7.8, 'Boxing, sparring'),
(15125, 'Sports', 9.3, 'Boxing, simulated boxing round, exercise'),
(15130, 'Sports', 7.0, 'Broomball'),
(15138, 'Sports', 6.0, 'Cheerleading, gymnastic moves, competitive'),
(15140, 'Sports', 4.0, 'Coaching, football, soccer, basketball, baseball, swimming, etc.'),
(15142, 'Sports', 8.0, 'Coaching, actively playing sport with players'),
(15150, 'Sports', 4.8, 'Cricket, batting, bowling, fielding'),
(15160, 'Sports', 3.3, 'Croquet'),
(15170, 'Sports', 4.0, 'Curling'),
(15180, 'Sports', 2.5, 'Darts, wall or lawn'),
(15190, 'Sports', 6.0, 'Drag racing, pushing or driving a car'),
(15192, 'Sports', 8.5, 'Auto racing, open wheel'),
(15195, 'Sports', 7.8, 'Futsal'),
(15200, 'Sports', 6.0, 'Fencing, general'),
(15203, 'Sports', 9.8, 'Fencing, epee, competitive'),
(15205, 'Sports', 9.9, 'Floorball'),
(15210, 'Sports', 8.0, 'Football, competitive'),
(15230, 'Sports', 8.0, 'Football, touch, flag, general (Taylor Code 510)'),
(15232, 'Sports', 4.0, 'Football, touch, flag, light effort'),
(15235, 'Sports', 2.5, 'Football or baseball, playing catch'),
(15240, 'Sports', 3.0, 'Frisbee playing, general'),
(15250, 'Sports', 8.0, 'Frisbee, ultimate'),
(15252, 'Sports', 3.8, 'Frisbee golf'),
(15255, 'Sports', 4.5, 'Golf, general'),
(15265, 'Sports', 4.3, 'Golf, walking, carrying clubs'),
(15270, 'Sports', 3.5, 'Golf, miniature, driving range'),
(15285, 'Sports', 4.5, 'Golf, walking, pulling clubs'),
(15290, 'Sports', 3.5, 'Golf, using power cart (Taylor Code 070)'),
(15300, 'Sports', 3.8, 'Gymnastics, general'),
(15310, 'Sports', 4.0, 'Hacky sack'),
(15320, 'Sports', 9.9, 'Handball, general (Taylor Code 520)'),
(15330, 'Sports', 8.0, 'Handball, team'),
(15335, 'Sports', 4.0, 'High ropes course, multiple elements'),
(15340, 'Sports', 3.5, 'Hang gliding'),
(15350, 'Sports', 7.8, 'Hockey, field'),
(15360, 'Sports', 8.0, 'Hockey, ice, general'),
(15362, 'Sports', 9.9, 'Hockey, ice, competitive'),
(15370, 'Sports', 5.5, 'Horseback riding, general'),
(15380, 'Sports', 4.5, 'Horse grooming, maintenance, saddling tasks'),
(15390, 'Sports', 5.8, 'Horseback riding, trotting'),
(15395, 'Sports', 7.3, 'Horseback riding, canter or gallop'),
(15400, 'Sports', 3.8, 'Horseback riding, walking'),
(15402, 'Sports', 9.0, 'Horseback riding, jumping'),
(15403, 'Sports', 6.0, 'Horseback riding, reining'),
(15406, 'Sports', 2.1, 'Horseback riding, simulator'),
(15408, 'Sports', 1.8, 'Horse cart, driving, standing or sitting'),
(15410, 'Sports', 3.0, 'Horseshoe pitching, quoits'),
(15420, 'Sports', 9.9, 'Jai alai'),
(15425, 'Sports', 5.3, 'Martial Arts, different types, slower pace, novice performers, practice'),
(15430, 'Sports', 9.9, 'Martial Arts, different types, moderate pace (e.g., judo, jujitsu, karate, kick boxing, tae kwon do, tai-bo, Muay Thai boxing)'),
(15432, 'Sports', 9.9, 'Taekwondo, combat simulation'),
(15433, 'Sports', 9.9, 'Judo'),
(15440, 'Sports', 4.0, 'Juggling'),
(15444, 'Sports', 6.5, 'Kendu, kihon-keiko style, moderate intensity'),
(15445, 'Sports', 9.6, 'Kendu, kirikaeshi style, high intensity'),
(15446, 'Sports', 9.9, 'Kendu, kakari keiko style, very high intensity'),
(15450, 'Sports', 7.0, 'Kickball'),
(15455, 'Sports', 5.5, 'Kung Fu Gymnastics'),
(15457, 'Sports', 7.3, 'Kickboxing'),
(15460, 'Sports', 8.0, 'Lacrosse'),
(15465, 'Sports', 3.3, 'Lawn bowling, bocce ball, outdoor'),
(15470, 'Sports', 4.0, 'Motocross, off-road motor sports, all-terrain vehicle, general'),
(15475, 'Sports', 5.3, 'Motorcycle racing, Supormoto racing'),
(15477, 'Sports', 7.0, 'Netball'),
(15480, 'Sports', 9.0, 'Orienteering'),
(15490, 'Sports', 9.9, 'Paddleball, competitive'),
(15500, 'Sports', 6.0, 'Paddleball, casual, general (Taylor Code 460)'),
(15503, 'Sports', 1.8, 'Paragliding, moderate altitude'),
(15506, 'Sports', 6.5, 'Prusik climbing'),
(15510, 'Sports', 8.0, 'Polo, on horseback'),
(15520, 'Sports', 9.9, 'Racquetball, competitive'),
(15525, 'Sports', 9.9, 'Race Walking, 3.1 m/s (6.9 mph)'),
(15527, 'Sports', 9.9, 'Race Walking, 3.7 m/s (8.3 mph)'),
(15528, 'Sports', 9.9, 'Race Walking, racing speed, 4.0 m/s (8.95 mph)'),
(15530, 'Sports', 7.0, 'Racquetball, general (Taylor Code 470)'),
(15533, 'Sports', 8.0, 'Rock or mountain climbing (Taylor Code 060), (formerly code 17120)'),
(15534, 'Sports', 8.8, 'Rock climbing, free boulder'),
(15535, 'Sports', 7.3, 'Rock climbing, ascending rock, high difficulty'),
(15536, 'Sports', 9.9, 'Rock climbing, speed climbing, very difficult'),
(15537, 'Sports', 5.8, 'Rock climbing, ascending or traversing rock, low-to-moderate difficulty'),
(15538, 'Sports', 9.9, 'Rock climbing, treadwall, 4-6 m/min'),
(15539, 'Sports', 9.9, 'Rock climbing, treadwall, 7-10 m/min'),
(15540, 'Sports', 5.0, 'Rock climbing, rappelling,'),
(15542, 'Sports', 4.0, 'Rodeo sports, general, light effort'),
(15544, 'Sports', 5.5, 'Rodeo sports, general, moderate effort'),
(15546, 'Sports', 7.0, 'Rodeo sports, general, vigorous effort'),
(15550, 'Sports', 9.9, 'Rope jumping, fast pace, 120-160 skips/min'),
(15551, 'Sports', 9.9, 'Rope jumping, moderate pace, general, 100 to 120 skips/min, 2 foot skip, plain bounce'),
(15552, 'Sports', 8.3, 'Rope jumping, slow pace, < 100 skips/min, 2 foot skip, rhythm bounce'),
(15554, 'Sports', 9.9, 'Rope jumping, double under or more'),
(15560, 'Sports', 8.3, 'Rugby, union, team, competitive'),
(15562, 'Sports', 6.3, 'Rugby, touch, non-competitive'),
(15570, 'Sports', 3.0, 'Shuffleboard'),
(15580, 'Sports', 5.0, 'Skateboarding, general, moderate effort'),
(15582, 'Sports', 6.0, 'Skateboarding, competitive, vigorous effort'),
(15590, 'Sports', 7.0, 'Skating, roller (Taylor Code 360)'),
(15591, 'Sports', 7.5, 'Roller blading, in-line skating, 14.4 km/h (9.0 mph), recreational pace'),
(15592, 'Sports', 9.8, 'Roller blading, in-line skating, 17.7 km/h (11.0 mph), moderate pace, exercise training'),
(15593, 'Sports', 9.9, 'Roller blading, in-line skating, 21.0 to 21.7 km/h (13.0 to 13.6 mph), fast pace, exercise training'),
(15594, 'Sports', 9.9, 'Rollerblading, in-line skating, 24.0 km/h (15.0 mph), maximal effort'),
(15595, 'Sports', 6.8, 'Skateboard, longboard, 13.3 km/h, slow speed'),
(15596, 'Sports', 8.3, 'Skateboard, longboard, 16.2 km/h, typical speed'),
(15597, 'Sports', 9.9, 'Skateboard, longboard, 13.3 km/h, fast speed'),
(15600, 'Sports', 3.5, 'Skydiving, base-jumping, bungee jumping'),
(15605, 'Sports', 9.5, 'Soccer, competitive'),
(15610, 'Sports', 7.0, 'Soccer, casual, general (Taylor Code 540)'),
(15615, 'Sports', 3.5, 'Walking football/soccer'),
(15620, 'Sports', 5.0, 'Softball or baseball, fast or slow pitch, general, moderate effort (Taylor Code 440)'),
(15625, 'Sports', 4.0, 'Softball, practice'),
(15630, 'Sports', 4.0, 'Softball, officiating'),
(15640, 'Sports', 6.0, 'Softball, pitching'),
(15645, 'Sports', 3.3, 'Sports spectator, very excited, emotional, physically moving'),
(15650, 'Sports', 9.9, 'Squash (Taylor Code 530)'),
(15652, 'Sports', 7.3, 'Squash, general'),
(15660, 'Sports', 4.0, 'Table tennis, ping pong (Taylor Code 410)'),
(15670, 'Sports', 3.3, 'Tai chi, qi gong, general'),
(15672, 'Sports', 1.5, 'Tai chi, qi gong, sitting, light effort'),
(15674, 'Sports', 6.0, 'Tai chi chuan, Yang style'),
(15675, 'Sports', 6.8, 'Tennis, general, moderate effort'),
(15676, 'Sports', 8.0, 'Tennis, general, competitive'),
(15680, 'Sports', 6.0, 'Tennis, doubles (Taylor Code 430)'),
(15685, 'Sports', 4.5, 'Tennis, doubles'),
(15690, 'Sports', 8.0, 'Tennis, singles (Taylor Code 420)'),
(15695, 'Sports', 5.0, 'Tennis, hitting balls, non-game play, moderate effort'),
(15700, 'Sports', 6.3, 'Trampoline, recreational'),
(15702, 'Sports', 9.9, 'Trampoline, competitive'),
(15710, 'Sports', 4.0, 'Volleyball (Taylor Code 400)'),
(15711, 'Sports', 6.0, 'Volleyball, competitive, in gymnasium'),
(15720, 'Sports', 3.0, 'Volleyball, non-competitive, 6 - 9 member team, general'),
(15725, 'Sports', 8.0, 'Volleyball, beach, in sand'),
(15730, 'Sports', 6.0, 'Wrestling, competitive (one match = 5 minutes)'),
(15731, 'Sports', 7.0, 'Wallyball, general'),
(15732, 'Sports', 4.0, 'Track and field (e.g., shot, discus, hammer throw)'),
(15733, 'Sports', 6.0, 'Track and field (e.g., high jump, long jump, triple jump, javelin, pole vault)'),
(15734, 'Sports', 9.9, 'Track and field (e.g., steeplechase, hurdles)'),
(16002, 'Transportation', 9.3, 'Bicycling for transportation, light effort'),
(16004, 'Transportation', 9.3, 'Bicycling for transportation, high effort'),
(16005, 'Transportation', 6.8, 'E-bike (electrically assisted) for transportation'),
(16010, 'Transportation', 2.0, 'Automobile or light truck (not a semi) driving'),
(16015, 'Transportation', 1.3, 'Riding in a car or truck'),
(16016, 'Transportation', 1.3, 'Riding in a bus or train'),
(16020, 'Transportation', 1.8, 'Flying airplane or helicoptor'),
(16030, 'Transportation', 2.8, 'Motor scooter, motorcycle'),
(16035, 'Transportation', 6.3, 'Pulling rickshaw'),
(16040, 'Transportation', 6.0, 'Pushing plane in and out of hangar'),
(16050, 'Transportation', 2.5, 'Truck, semi, tractor, ≥1 ton, or bus, driving'),
(16060, 'Transportation', 3.5, 'Walking for transportation, 2.8-3.2 mph, level, moderate pace, firm surface'),
(17010, 'Walking', 7.0, 'Backpacking (Taylor Code 050)'),
(17011, 'Walking', 3.5, 'Walking with a day pack, level ground, assumed in the city'),
(17012, 'Walking', 7.8, 'Backpacking,  hiking with a daypack, organized walking with daypack'),
(17016, 'Walking', 4.0, 'Carrying 5 to 14 lb (2.3 to 6.4 kg) load (e.g. suitcase, boxes, groceries), level ground, moderate pace'),
(17018, 'Walking', 4.5, 'Carrying 15 - 155 lb (6.8 - 70.4 kg) load (e.g. suitcase, boxes, furniture), level ground or downstairs, slow pace'),
(17019, 'Walking', 6.5, 'Carrying 50 to 150 pound load (e.g., equine or bovine feed, fence pipes, furniture), level ground, moderate pace'),
(17021, 'Walking', 2.3, 'Carrying ~10 lb child, slow walking'),
(17025, 'Walking', 8.3, 'Carrying load upstairs, general'),
(17026, 'Walking', 5.5, 'Carrying load, 1 to 15 lb load, upstairs'),
(17027, 'Walking', 6.0, 'Carrying load, 16 to 24 lb load, upstairs'),
(17028, 'Walking', 8.0, 'Carrying load, 25 to 49 lb load, upstairs'),
(17029, 'Walking', 9.9, 'Carrying load, 50 to 74 lb load, upstairs'),
(17030, 'Walking', 9.9, 'Carrying load, >74 lb load, upstairs'),
(17031, 'Walking', 3.8, 'Loading  and/or unloading a car, implied walking'),
(17032, 'Walking', 5.0, 'Climbing hills, no load, 5 to 20% grade, very slow pace'),
(17033, 'Walking', 3.8, 'Climbing hills, 15-50 lb load, 1 to 2% grade, slow pace'),
(17034, 'Walking', 5.3, 'Climbing hills, no load, 1 to 5% grade, moderate-to-brisk pace'),
(17035, 'Walking', 7.0, 'Climbing hills, no load, 6 to 10% grade, moderate-to-brisk pace'),
(17036, 'Walking', 8.8, 'Climbing hills, no load, 11 to 20% grade, slow-to-moderate pace'),
(17037, 'Walking', 9.9, 'Climbing hills, no load, 4.0 to 5.0 mph, 3 to 5% grade, very fast pace'),
(17038, 'Walking', 8.5, 'Climbing hills, no load, steep grade (30%), slow pace (less than 1.2 mph)'),
(17039, 'Walking', 9.9, 'Climbing hills, no load, very steep grade (30-40%), 1.2 to 1.8 mph'),
(17040, 'Walking', 9.9, 'Climbing hills, no load, steep grade (10-40%), 1.8 to 5.0 mph'),
(17045, 'Walking', 6.5, 'Climbing hills, 10 to 20 lb load, 5 to 10% grade, moderate'),
(17050, 'Walking', 7.5, 'Climbing hills, 21 to 40 lb load, 3 to 10% grade, moderate-to-brisk pace'),
(17060, 'Walking', 9.9, 'Climbing hills, 20+ pound load, 5 to 20% grade, moderate to brisk pace'),
(17070, 'Walking', 3.5, 'Descending stairs'),
(17076, 'Walking', 4.5, 'Hauling water, head hauling, walking on flat surface'),
(17080, 'Walking', 6.0, 'Hiking, cross country (Taylor Code 040)'),
(17081, 'Walking', 3.8, 'Hiking slowly or ambling through fields and hillsides, no load'),
(17082, 'Walking', 5.3, 'Hiking or walking at a normal pace through fields and hillsides, no load'),
(17085, 'Walking', 2.5, 'Bird watching, walking and stopping'),
(17088, 'Walking', 4.5, 'Marching, moderate speed, military, no pack'),
(17090, 'Walking', 8.0, 'Marching rapidly, military, no pack'),
(17100, 'Walking', 3.8, 'Pushing or pulling stroller with child or walking with children, 2.5 to 3.1 mph'),
(17105, 'Walking', 3.8, 'Pushing a wheelchair, non-occupational'),
(17110, 'Walking', 6.5, 'Race walking'),
(17130, 'Walking', 8.0, 'Stair climbing, using or climbing up ladder (Taylor Code 030)'),
(17131, 'Walking', 6.8, 'Stair climbing, general'),
(17133, 'Walking', 4.5, 'Stair climbing, slow pace'),
(17134, 'Walking', 9.3, 'Stair climbing, fast pace, one step at a time'),
(17136, 'Walking', 7.5, 'Stair climbing, two steps at a time'),
(17138, 'Walking', 7.5, 'Stair climbing, ascending and descending stairs'),
(17140, 'Walking', 4.5, 'Using crutches, level ground, general'),
(17142, 'Walking', 7.0, 'Using crutches, fast pace'),
(17145, 'Walking', 4.3, 'Using medical knee scooter'),
(17150, 'Walking', 2.3, 'Walking, household'),
(17151, 'Walking', 2.3, 'Walking, less than 2.0 mph, level, strolling, very slow'),
(17152, 'Walking', 2.8, 'Walking, 2.0 to 2.4 mph, level, slow pace, firm surface'),
(17160, 'Walking', 3.5, 'Walking for pleasure (Taylor Code 010)'),
(17161, 'Walking', 2.5, 'Walking from house to car or bus, from car or bus to go places, from car or bus to and from the worksite'),
(17162, 'Walking', 2.5, 'Walking to neighbor’s house or family’s house for social reasons'),
(17165, 'Walking', 3.0, 'Walking the dog'),
(17170, 'Walking', 3.0, 'Walking, 2.5 mph, firm, level surface'),
(17180, 'Walking', 3.3, 'Walking, 2.5 mph, downhill'),
(17190, 'Walking', 3.8, 'Walking, 2.8 to 3.4 mph, level, moderate pace, firm surface'),
(17200, 'Walking', 4.8, 'Walking, 3.5 to 3.9 mph, level, brisk, firm surface, walking for exercise'),
(17220, 'Walking', 5.5, 'Walking, 4.0 to 4.4 mph (6.4 to 7.0 km/h), level, firm surface, very brisk pace'),
(17230, 'Walking', 7.0, 'Walking, 4.5 to 4.9 mph, level, firm surface, very, very brisk'),
(17231, 'Walking', 8.5, 'Walking, 5.0 to 5.5 mph (8.8 to 8.9 km/h), level, firm surface'),
(17250, 'Walking', 3.5, 'Walking, for pleasure, work break (Taylor Code xxx)'),
(17255, 'Walking', 4.0, 'Walking, self-selected speed, indoor track or outdoors, firm surface'),
(17260, 'Walking', 4.8, 'Walking, grass track'),
(17262, 'Walking', 4.5, 'Walking, normal pace, plowed field or sand'),
(17270, 'Walking', 4.0, 'Walking, to work or class (Taylor Code 015)'),
(17280, 'Walking', 2.5, 'Walking, to and from an outhouse'),
(17302, 'Walking', 4.3, 'Walking, for exercise, 2.5 to 3.5 mph (4.0 to 5.6 km/h), with ski poles, Nordic walking, level, moderate pace'),
(17304, 'Walking', 5.3, 'Walking, for exercise, 3.6 to 4.4 mph (5.8 to 7.1 km/h), with ski poles, Nordic walking, level, moderate pace'),
(17305, 'Walking', 8.5, 'Walking, for exercise, 4.5 to 5.0 mph, with ski poles, Nordic walking, level, fast pace'),
(17310, 'Walking', 8.8, 'Walking, for exercise, with ski poles, Nordic walking, uphill, moderate pace'),
(17313, 'Walking', 9.9, 'Walking, for exercise, with ski poles, Nordic walking, level ground, carrying 20 to 30 lb load (9.0 to 15.0 kg)'),
(17315, 'Walking', 9.9, 'Walking, for exercise, with ski poles, Nordic walking, uphill, carrying 20 to 30 lb load (9.0 to 15.0 kg)'),
(17320, 'Walking', 6.0, 'Walking, backward, 3.5 mph, level'),
(17325, 'Walking', 7.8, 'Walking, backward, 3.5 mph, uphill, 5% grade'),
(17330, 'Walking', 8.0, 'Walking, Teabag walk, Monty Python Ministry of Silly Walks'),
(17332, 'Walking', 3.5, 'Walking, Putey walk, Monty Python Ministry of Silly Walks'),
(17340, 'Walking', 2.1, 'Walking, treadmill, less than 1.0 mph, 0% grade'),
(17343, 'Walking', 2.3, 'Walking, treadmill, 1.0 mph, 0% grade'),
(17346, 'Walking', 2.8, 'Walking, treadmill, 1.2 to 1.9 mph, 0% grade (1.9 to 3.0 km/h)'),
(17349, 'Walking', 3.0, 'Walking, treadmill, 2.0 to 2.4 mph (3.2 to 3.9 km/h), 0% grade'),
(17352, 'Walking', 3.5, 'Walking, treadmill, 2.5 to 2.9 mph (4.0 to 4.7 km/h), 0% grade'),
(17355, 'Walking', 3.8, 'Walking, treadmill, 3.0 to 3.4 mph (4.8 to 5.5 km/h), 0% grade'),
(17358, 'Walking', 4.8, 'Walking, treadmill, 3.5 to 3.9 mph (5.6 to 6.3 km/h), 0% grade'),
(17361, 'Walking', 5.8, 'Walking, treadmill, 4.0 to 4.4 mph (6.4 to 7.1 km/h), 0% grade'),
(17364, 'Walking', 6.8, 'Walking, treadmill, 4.5 to 4.9 mph (7.2 to 7.9 km/h), 0% grade'),
(17367, 'Walking', 8.3, 'Walking, treadmill, 5.0 to 5.5 mph (8.0 to 8.9 km/h), 0% grade'),
(17382, 'Walking', 3.3, 'Walking, treadmill, downhill (-3% to -12% grade), 2.8 to 3.1 mph'),
(17412, 'Walking', 3.3, 'Walking, treadmill, downhill (-5% to -25% grade), 2.8 mph, with Nordic Poles'),
(17434, 'Walking', 4.8, 'Walking, treadmill, 2.5 mph, 0% grade, 5 to 20 degrees C, 40 lb (18.2 kg) load'),
(17438, 'Walking', 5.8, 'Walking, treadmill, 2.5 mph, 0% grade, -10 to 0 degrees C, 40 lb (18.2 kg) load'),
(17455, 'Walking', 8.3, 'Walking, Curved treadmill, 3.0 to 5.0 mph, brisk pace'),
(17475, 'Walking', 7.8, 'Walking treadmill, backwards, 2.5 mph, +10% grade'),
(17492, 'Walking', 1.5, 'Walking, with a walker or step-to gait on treadmill, 0.7 mph (1.1 km/h), 0% grade');

-- --------------------------------------------------------

--
-- Table structure for table `food_entries`
--

CREATE TABLE `food_entries` (
  `food_entry_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_type` varchar(3) NOT NULL,
  `date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_entry_items`
--

CREATE TABLE `food_entry_items` (
  `food_entry_item_id` int(11) NOT NULL,
  `food_entry_id` int(11) NOT NULL,
  `query` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(24) NOT NULL,
  `last_name` varchar(36) NOT NULL,
  `password` varchar(256) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `activity_level` varchar(6) NOT NULL,
  `body_fat_percent` int(11) NOT NULL,
  `weight_preference` varchar(5) NOT NULL DEFAULT 'mntn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_activities`
--

CREATE TABLE `workout_activities` (
  `workout_activity_id` int(11) NOT NULL,
  `workout_plan_id` int(11) NOT NULL,
  `activity_code` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `effort` varchar(8) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL,
  `frequency` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workout_plans`
--

CREATE TABLE `workout_plans` (
  `workout_plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compendium_of_physical_activities`
--
ALTER TABLE `compendium_of_physical_activities`
  ADD PRIMARY KEY (`activity_code`);
ALTER TABLE `compendium_of_physical_activities` ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `food_entries`
--
ALTER TABLE `food_entries`
  ADD PRIMARY KEY (`food_entry_id`);

--
-- Indexes for table `food_entry_items`
--
ALTER TABLE `food_entry_items`
  ADD PRIMARY KEY (`food_entry_item_id`),
  ADD KEY `food_entry_id` (`food_entry_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workout_activities`
--
ALTER TABLE `workout_activities`
  ADD PRIMARY KEY (`workout_activity_id`),
  ADD KEY `workout_plan_id_workout_activities` (`workout_plan_id`),
  ADD KEY `activity_code_workout_activities` (`activity_code`);

--
-- Indexes for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD PRIMARY KEY (`workout_plan_id`),
  ADD KEY `user_id_workout_plans` (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_entry_items`
--
ALTER TABLE `food_entry_items`
  ADD CONSTRAINT `food_entry_id` FOREIGN KEY (`food_entry_id`) REFERENCES `food_entries` (`food_entry_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `workout_activities`
--
ALTER TABLE `workout_activities`
  ADD CONSTRAINT `activity_code_workout_activities` FOREIGN KEY (`activity_code`) REFERENCES `compendium_of_physical_activities` (`activity_code`),
  ADD CONSTRAINT `workout_plan_id_workout_activities` FOREIGN KEY (`workout_plan_id`) REFERENCES `workout_plans` (`workout_plan_id`);

--
-- Constraints for table `workout_plans`
--
ALTER TABLE `workout_plans`
  ADD CONSTRAINT `user_id_workout_plans` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
