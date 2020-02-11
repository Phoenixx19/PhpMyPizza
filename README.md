# PhpMyPizza
[![GitHub release (latest by date including pre-releases)](https://img.shields.io/github/v/release/Phoenixx19/PhpMyPizza?include_prereleases)](https://github.com/Phoenixx19/PhpMyPizza/releases)
 
**PhpMyPizza &copy;** e' un gestore di ordini per ristoranti "piu' tecnologici".
PhpMyPizza e' basato su *PHP* come linguaggio di programmazione e *SQL (MySQL)* per la gestione del intero ristorante. 

## Requisiti
> I requisiti sono basati su test effettuati in precedenza su [XAMPP](https://www.apachefriends.org/index.html) versione 7.1.3.
> Non e' garantito il funzionamento utilizzando versioni di **PHP<5.3**.

Per *PhpMyPizza&copy;* e' necessario essere in possesso di un webserver o un server con:
- Apache 2.4.39 **oppure** Nginx (non testato)
- PHP 7.1.30
- MySQL 5.6.33
- PHPMyAdmin (consigliato)

Nel webserver, e' consigliato l'uso del root (cioe' la cartella /) per ottenere il corretto funzionamento del intero pacchetto.

## Installazione
1. Per installare PHPMyPizza&copy; semplicemente scaricare dalle **[releases]()** la versione piu' recente, dopo aver scaricato il file .zip sara' necessario aprire il file .zip e trascinare la cartella sul root del webserver.

2. In seguito si dovra' spostare tutti gli elementi all'interno della cartella al di' fuori (e eliminare la cartella ormai inutile).

3. Aprire il webserver nel caso non sia gia' stato fatto partire e collegatevi tramite qualsiasi browser. Sara' richiesto il completamento di due form dove verranno richiesti le credenziali del database.


4. Al completamento verra' richiesto il login. 

Dopo l'inserimento corretto del account, sara' possibile accedere a PhpMyPizza&copy;. :)

<br>
<hr>

## FAQ
### Come creo o inserisco un ordine?
Semplicemente premi su `Prendi Ordini` e inserisci i dati richiesti.
Una volta inserito andare su `Cucina` per controllare il corretto funzionamento.

Se il pop-up non appare prova a disabilitare il blocco di pop-up sul tuo dispositivo.

<br>

### Come pago il conto?
Andare su `Conti` e premere sul tasto affianco al tavolo interessato. Si aprira' un pop-up all'interno della pagina (modal) dove sara' possibile controllare il conto di un tavolo, sono applicati coperto e tasse aggiuntive modificabili sulle impostazioni. Una volta confermato il pagamento, i record del tavolo completati vengono eliminati. 

Nelle versioni future sarà possibile salvare i record per le statistiche.

<br>

### Dove modifico le impostazioni?
Aprendo `Impostazioni` sara' possibile modificare le impostazioni. Nella barra a sinistra si trovano le possibili impostazioni modificabili e premendo una delle possibili si verra' indirizzati nella barra a destra. **E' importante cambiare le impostazioni solo se necessario, in caso di errori, riconfigurare** `config.ini`.

Se si sta accedendo per la prima volta al sito, il file di configurazione non sarà disponibile poiche viene creato alla fine della configurazione iniziale.

<br>

### Come inserisco o elimino un account?
Andando su `Utenti` si potranno gestire gli utenti nel sito, premendo **+** sulla barra a lato verrà richiesto un form per l'inserimento di un user, a seconda della categoria del proprio account si potranno utilizzare più o meno pagine nel sito.

|Level|Tipo|Pagine|
|:---:|:---:|:---|
|0|Admin|/|
|1|Gestore sala|/, Impostazioni (solo lettura)|
|2|Cameriere/Cuoco|Cucina, Prendi ordini, Conto|
|-|Visitatore|Menu|


<br>

### Come modifico il menu? *(avanzato)*
Per modificare il menu occorre accedere a PhpMyAdmin, per fare cio' recatevi sulla homepage e aggiungiete  `/phpmyadmin/`. Eseguire il login e andare sul vostro database utilizzato per PhpMyPizza e selezionare la tabella `menu`.
Una volta entrati nella tabella sarà possibile gestire il proprio menu.

Se si vogliono cancellare i dati all'interno della tabella premere su **Operazioni** quindi **Svuota la tabella (TRUNCATE)**.

>E' importante non cancellare definitivamente la tabella con il `DROP`, poiché molte funzionalità del sito potrebbero non funzionare. Per poter riaggiungere una tabella sarà richiesto utilizzare le query interessate all'interno del file `/php/first_access.inc.php`.

Nell'assenza di PhpMyAdmin, occorre inserire manualmente le query manualmente tramite CLI di MySQL oppure utilizzare un'altro DBMS.

<br>

### Come condivido un bug che ho trovato?
Nella sezione **[issues]()** è possibile inserire eventuali bug per migliorare l'esperienza futura del pacchetto PhpMyPizza. Il nostro pacchetto si basa sugli utilizzi di tutti, e con 

<br>
<br>

💕 with love,

 [Andrea Seppi](), [Giulio Furlan]() con l'aiuto di [Matteo Diblas](). 

&copy; PhpMyPizza Labs, 2019-2020
