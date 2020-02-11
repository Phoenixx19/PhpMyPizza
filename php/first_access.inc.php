<?php
    require('../resources/functions.php');
    $arrayconf = array(
        'CONFIG' => array(
            'site' => $_POST["site"],
            'hostname' => $_POST["hostname"],
            'user' => $_POST["user"],
            'password' => $_POST["password"],
            'dbname' => $_POST["dbname"]
        ),
        'INFO' => array(
            'name' => $_POST["name"],
            'ntables' => 30,
            'tax' => 5,
            'cover' => 2
        ),
        'LANG' => array(
            'language' => $_POST["lang"]
        ),
        'LOOKNFEEL' => array(
            'theme' => $_POST["style"]
        )
    );

    //write into ini file
    write_php_ini($arrayconf, '../config.ini');

    $conn = mysqli_connect($_POST["hostname"], $_POST["user"], $_POST["password"], $_POST["dbname"]);

    if(!$conn) {
        header('Location: ../errors/db.php');
    }

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    //query db creation
    $sqldb = "CREATE DATABASE IF NOT EXISTS ".$_POST["dbname"].";";
    $result = $conn->query($sqldb);


    //query tables and menu creation
    $sqltables = "CREATE TABLE IF NOT EXISTS `c_orders` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `refid_user` int(11) DEFAULT NULL,
            `refid_menu` int(11) NOT NULL,
            `quantity` int(11) DEFAULT NULL,
            `table_number` int(11) DEFAULT NULL,
            `edits` tinytext CHARACTER SET utf16 COLLATE utf16_bin,
            `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
      
      CREATE TABLE IF NOT EXISTS `menu` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` tinytext CHARACTER SET utf8 COLLATE utf8_bin,
            `price` double DEFAULT NULL,
            `photo_url` tinytext,
            `descrizione` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
            `tipo` varchar(50) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        
        INSERT INTO `menu` (`id`, `name`, `price`, `photo_url`, `descrizione`, `tipo`) VALUES
            (1, 'Antipasto all''Italiana', 12, 'http://media.gustoblog.it/e/e28/antipasto-allitaliana-decorazioni.jpg', 'Un antipasto all''Italiana.', 'Antipasti'),
            (2, 'Prosciutto e melone', 12, 'https://blog.giallozafferano.it/danielacakes/wp-content/uploads/2018/06/IMG_20180626_182309_961.jpg', 'Il classico prosciutto e melone.', 'Antipasti'),
            (3, 'Prosciutto di Parma', 9, 'https://thumbs.dreamstime.com/b/crudo-affettato-di-prosciutto-parma-108474191.jpg', 'Prosciutto affettato di Parma, l''originale.', 'Antipasti'),
            (4, 'Antipasto della casa', 5, 'https://i.pinimg.com/originals/79/e3/bf/79e3bf0af8228206112554a12f90f477.jpg', 'Di produzione propria.', 'Antipasti'),
            (5, 'Bruschetta al Pomodoro', 1.6, 'https://static.pourfemme.it/pfricette/fotogallery/pp/850x480/32651/bruschette-al-forno.jpg', 'Bruschetta al pomodoro.', 'Antipasti'),
            (6, 'Mozzarella di Bufala', 5, 'https://media-cdn.tripadvisor.com/media/photo-s/0f/d3/6a/90/antipasto-con-mozzarella.jpg', 'Un antipasto a prova di Bufala.', 'Antipasti'),
            (7, 'Ravioli di ricotta e spinaci', 11, 'https://www.lospicchiodaglio.it/img/ricette/raviolispinaciburrosalvia.jpg', 'Ravioli ripieni.', 'Primi Piatti'),
            (8, 'Bucatini all''amatriciana', 11, 'https://www.cucchiaio.it/content/cucchiaio/it/ricette/2014/04/ricetta-bucatini-allamatriciana/jcr:content/header-par/image_single.img10.jpg/1442407342789.jpg', 'Pasta con una delle salse più prelibate in Italia.', 'Primi Piatti'),
            (9, 'Spaghetti alle vongole', 12, 'https://statics.cucchiaio.it/content/cucchiaio/it/ricette/2017/01/spaghetti-vongole/jcr:content/procedure-par/recipe_procedures_2124925535/image.img6.jpg/1484562677312.jpg', 'Di produzione propria.', 'Primi Piatti'),
            (10, 'Risotto alla pescatora', 12, 'http://www.osteriadacarmela.it/wp-content/uploads/2015/11/Risotto-alla-pescatora.jpg', 'Risotto ai frutti di mare, anche se non è vero.', 'Primi Piatti'),
            (11, 'Spaghetti alla Carbonara', 11, 'https://blog.giallozafferano.it/lebistro/wp-content/uploads/2018/10/PASTA-ALLA-CARBONARA.jpg', 'Classico piatto di origine italiana.', 'Primi Piatti'),
            (12, 'Tonnarelli cacio e pepe', 10, 'https://www.ilgiornaledelcibo.it/wp-content/uploads/2011/07/pasta-cacio-e-pepe.jpg', 'Spaghetti più spessi.', 'Primi Piatti'),
            (13, 'Lasagne', 10, 'https://hips.hearstapps.com/vidthumb/images/180820-bookazine-delish-01280-1536610916.jpg', 'Di sicuro non è un pasticcio.', 'Primi Piatti'),
            (14, 'Bistecca ai ferri', 20, 'http://www.sentio.it/wp-content/uploads/2011/07/2095439638_2549a9b65d_z.jpg', 'Una bistecca buona sicuramente.', 'Secondi Piatti'),
            (15, 'Tagliata danese (250 grammi)', 22, 'https://static.cookist.it/wp-content/uploads/sites/21/2018/09/tagliata-di-manzo-segreti-638x425.jpg', 'Classico prodotto danese.', 'Secondi Piatti'),
            (16, 'Filetto Danese', 24, 'https://images.lacucinaitaliana.it/wp-content/uploads/2016/02/come-cucinare-il-filetto.jpg', 'Classico prodotto danese.', 'Secondi Piatti'),
            (17, 'Salsicce (3 pezzi)', 13, 'https://www.gustoetradizioneabruzzo.com/wp-content/uploads/2016/10/salsicce-fresche-di-maiale-abruzzesi.jpg', 'Direttamente dall''Austria.', 'Secondi Piatti'),
            (18, 'Grigliata mista', 22, 'https://static.cookist.it/wp-content/uploads/sites/21/2018/03/grigliata-di-carne.jpg', 'Abbacchio, arista, salsiccia e manzo.', 'Secondi Piatti'),
            (19, 'Galletto alla diavola', 16.5, 'https://gbc-cdn-public-media.azureedge.net/img61232.768x512.jpg', 'Un gallo intero cucinato con le peggior spezie.', 'Secondi Piatti'),
            (20, 'Lombata di vitella', 21, 'https://images.lacucinaitaliana.it/wp-content/uploads/2016/02/Lombata-di-vitello-al-forno.jpg', 'Carne di vitello.', 'Secondi Piatti'),
            (21, 'Margherita', 8, 'http://finedininglovers-it.cdn.crosscast-system.com/BlogPost/l_7472_pizza-salvo.jpg', 'Pizza margherita, l''originale.', 'Pizze'),
            (22, 'Napoli', 8.5, 'https://wips.plug.it/cips/buonissimo.org/cms/2012/07/pizza-napoli-5.jpg', 'Napoletana di origine e di fatto.', 'Pizze'),
            (23, 'Capricciosa', 9.5, 'https://www.ifood.it/wp-content/uploads/2018/04/Evidenza-Pizza-Capricciosa-1060x600.jpg', 'La classica pizza capricciosa.', 'Pizze'),
            (24, 'Funghi', 8.5, 'https://images.fidhouse.com/fidelitynews/wp-content/uploads/sites/6/2016/03/1457510916_110db3373692fa8c5a4526c9c5822483cdb11ffd-1046049218.jpg', 'Pizza con i funghi', 'Pizze'),
            (25, 'Basilico', 8.5, 'https://img.grouponcdn.com/deal/Su2wfPNRnkkeLceiEmq91dkTcW5/Su-700x420/v1/c700x420.jpg', 'Pizza di origine locale.', 'Pizze'),
            (26, 'Ai quattro formaggi', 10, 'https://www.bofrost.it/writable/products/images-v2/15197.jpg', 'Con 4 tipi differenti di formaggio.', 'Pizze'),
            (27, 'Vegetariana', 11, 'https://www.bofrost.it/writable/products/images-v2/15163.jpg', 'Pizza per persone intolleranti.', 'Pizze'),
            (28, 'Diavola', 9, 'https://www.silviocicchi.com/pizzachef/wp-content/uploads/2015/03/d2.jpg', 'Pizza piccante ma non troppo.', 'Pizze'),
            (29, 'Patatine fritte', 5, 'https://cdnb.ricettedigusto.info/2016/02/Patate-fritte-croccanti.jpg', '', 'Contorni'),
            (30, 'Insalata mista', 4.5, 'http://www.samurai-sushi.it/wp-content/uploads/2015/07/13.jpg', 'Con radicchio, pomodoro e rucola.', 'Contorni'),
            (31, 'Spinaci al burro e parmigiano', 5, 'https://www.ricettedigusto.info/wp-content/uploads/2016/02/Spinaci-al-burro-e-parmigiano-dopo-la-cottura.jpg', 'Con Parmigiano Reggiano.', 'Contorni'),
            (32, 'Vino bicchiere', 3, 'https://www.gamberorosso.it/wp-content/uploads/vino-rosso-1-768x512.jpg', 'A scelta.', 'Bevande'),
            (33, 'Acqua (500ml)', 2, 'https://www.valevend-shop.it/1086-large_default/acqua-naturale-vera-in-bottiglietta-pet-50-cl-confezione-da-24-pezzi.jpg', 'Naturale o frizzante.', 'Bevande'),
            (34, 'Bibita (lattina)', 2, 'https://www.gamescafe.it/wp-content/uploads/2018/12/bibita-lattina.png', 'Coca Cola, Fanta, Sprite, Pepsi.', 'Bevande'),
            (35, 'Birra (500ml)', 2.5, 'http://mangiarebuono.it/wp-content/uploads/2014/10/birra-artigianale.jpg', 'A scelta.', 'Bevande'),
            (36, 'The (330ml)', 2, 'https://www.leitv.it/wp-content/uploads/2013/07/te-freddo-in-casa.jpg?v=433', 'Pesca, limone o verde.', 'Bevande'),
            (37, 'Crem Caramel', 6, 'https://www.misya.info/wp-content/uploads/2014/01/Creme-caramel1.jpg', '', 'Desserts'),
            (38, 'Panna cotta', 6, 'https://www.fifteenspatulas.com/wp-content/uploads/2011/08/Panna-Cotta-Fifteen-Spatulas-2.jpg', 'Al cioccolato, ai frutti di bosco e al caramello', 'Desserts'),
            (39, 'Macedonia di frutta fresca', 6, 'https://www.nonnapaperina.it/wp-content/uploads/2013/04/macedonia-con-e-senza-gelato-792x450.jpg', 'Con fragole e banane.', 'Desserts'),
            (40, 'Anguria', 2.5, 'https://filecdn.nonsprecare.it/wp-content/uploads/2013/07/come-scegliere-una-buona-anguria.png', 'Frutta mista.', 'Desserts'),
            (41, 'Fragole', 6, 'http://www.ricetteperbimby.it/foto-ricette/gelato-alle-fragole-veloce-bimby.jpg', 'Con gelato o con limone e zucchero.', 'Desserts'),
            (42, 'Ananas', 6, 'http://www.alimentis.it/wp-content/uploads/2016/03/fetteananas-600x600.jpg', 'Frutta mista.', 'Desserts'),
            (43, 'Tartufo', 6, 'https://static.wixstatic.com/media/809660_aab71d987deb49a9ac31cc0eb26da0a6~mv2.jpg/v1/fill/w_480,h_480,al_c,q_85,usm_0.66_1.00_0.01/809660_aab71d987deb49a9ac31cc0eb26da0a6~mv2.jpg', 'Bianco (con gelato alla vaniglia) o nero (con gelato al cioccolato)', 'Desserts'),
            (44, 'Gelato', 6, 'https://filecdn.nonsprecare.it/wp-content/uploads/2013/07/come-riconoscere-un-buon-gelato-artigianale-consigli.jpg', 'Al limone, al cocco e alla vaniglia', 'Desserts'),
            (45, 'Dolci fatti in casa', 6, 'http://www.pyramidencafe.it/wp-content/uploads/2011/07/kaesesahne-290x217.jpg', 'Prodotti da noi.', 'Desserts');

        CREATE TABLE IF NOT EXISTS `orders` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `refid_user` int(11) DEFAULT NULL,
            `refid_menu` int(11) NOT NULL,
            `quantity` int(11) DEFAULT NULL,
            `table_number` int(11) DEFAULT NULL,
            `edits` tinytext CHARACTER SET utf16 COLLATE utf16_bin,
            `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` tinytext NOT NULL,
            `surname` tinytext NOT NULL,
            `username` tinytext,
            `psw` tinytext,
            `photo_url` tinytext NOT NULL,
            `level` tinyint(4) NOT NULL,
            `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    ";
    $restables = $conn->query($sqltables);


    //insert account
    $sqlacc = "INSERT INTO `users` (`id`, `name`, `surname`, `username`, `psw`, `photo_url`, `level`, `registered`) VALUES
            (NULL, '".$_POST['usrname']."', '".$_POST['usrsurname']."', '".$_POST['usrusername']."', MD5('".$_POST['usrpassword']."'), '', 0, CURRENT_TIMESTAMP),
            (NULL, 'once u created another account', 'delete me', 'user1', 'pswd', '', 1, CURRENT_TIMESTAMP),
            (NULL, 'once u created another account', 'delete me', 'user2', 'pswd', '', 2, CURRENT_TIMESTAMP);";
    $resultacc = $conn->query($sqlacc);

    //automated delete query
    if ($_POST['querycheck']==true) {
        $sqlquery = "CREATE EVENT delete_event
                    ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 15 MINUTE
                    ON COMPLETION PRESERVE
    
                    DO BEGIN
                        DELETE orders WHERE timestamp < DATE_SUB(NOW(), INTERVAL 90 MINUTE);
                    END;";
        $resultquery = $conn->query($sqlquery);
    }
?>

<script>window.location.href = '../login/';</script>