<!-- creiamo con Laravel un sistema customizzato di gestione del nostro Portfolio di progetti. Questo progetto lo porteremo avanti fino alla fine di Novembre, usando varie repo, é quindi di massima importanza che ci lavoriate con cura e in modo dettagliato.

Oggi iniziamo un nuovo progetto che si arricchirà nel corso delle prossime lezioni: man mano aggiungeremo funzionalità e vedremo la nostra applicazione crescere ed evolvere.

Nel pomeriggio, rifate ciò che abbiamo visto insieme stamattina stilando tutto a vostro piacere utilizzando Bootstra/SASS.

Descrizione:
Ripercorriamo gli steps fatti a lezione ed iniziamo un nuovo progetto usando laravel breeze ed il pacchetto Laravel 9 Preset con autenticazione.

Iniziamo con il definire il layout, modello, migrazione, controller e rotte necessarie per il sistema portfolio:
Autenticazione: si parte con l'autenticazione e la creazione di un layout per back-office

Creazione del modello Project con relativa migrazione, seeder, controller e rotte

Per la parte di back-office creiamo un resource controller Admin\\ProjectController per gestire tutte le operazioni CRUD dei progetti

Bonus
Implementiamo la validazione dei dati dei Progetti nelle operazioni CRUD che lo richiedono usando due form requests. -->





- collegare page soft delete

- stile tutte pagine



<!-- 

continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo e aggiungiamo una nuova entità Type.

Questa entità rappresenta la tipologia di progetto ed è in relazione one to many con i progetti.

I task da svolgere sono diversi, ma alcuni di essi sono un ripasso di ciò che abbiamo fatto nelle lezioni dei giorni scorsi:

creare la migration per la tabella types

creare il model Type

creare la migration di modifica per la tabella projects per aggiungere la chiave esterna

aggiungere ai model Type e Projecti metodi per definire la relazione one to many

visualizzare nella pagina di dettaglio di un progetto la tipologia associata, se presente

permettere all’utente di associare una tipologia nella pagina di creazione e modifica di un progetto

gestire il salvataggio dell’associazione progetto-tipologia con opportune regole di validazione



Bonus 1 (non opzionale):

creare il seeder per il model Type.

Bonus 2 (opzionale):

aggiungere le operazioni CRUD per il model Type, in modo da gestire le tipologie di progetto direttamente dal pannello di amministrazione.

 -->

# creo il model, migration & seed Tecnology/Tecnologies

- php artisan make:model Tecnology -ms

## popolo con seed di TecnologySeeder

 - php artisan db:seed --class=TecnologySeeder

### creo la cartella placeholders in torgae/app/public/storage/project_images + placeholders

- php artisan storage:link

#### sedeer db

- php artisan db:seed

- php artisan make:migration create_project_technology_table

php

$table->unsignedBigInteger('project_id');
$table->foreign('project_id')->reference('id')->on('project');

$table->unsignedBigInteger('technology_id');
$table->foreign('technology_id')->reference('id')->on('technology');

$table->primary(['project_id', 'technology_id']);

php

#### migrazione

- php artisan migrate

#### Tecnology & Project model

- Tecnology -> public fn projects(): BelongsToMany
                return $this->belongsToMany(Project::class);

- Project -> public fn technologies(): BelongsToMany
                return $this->belongsToMany(Technology::class);


                
###### create 

- $technologies = Tecnology:all();


#### SoftDeletes

- Model Name implementare use SoftDeletes e relativo percorso se non implementata in automatico

- creare una migrazione con php artisan make:migration add_delete_at_column_to_projects_table

- dentro la migrazione, nello schema::table inserire $table->SoftDeletes() e in down() $table->dropSoftDeletes()

- eseguire la migrate per generare la colonna nel db php artisan migrate

- controllare in phpMyAdmin se presente la colonna con valore di default NULL

- aprire il server virtuale e provare a cancellare un project e in phpMyAdmin verificare se al posto di NULL è stata inseritaa la data di cancellazione

- creare una route e una nuova page recycle

- in web.php creare una rotta Route::get('recycle', [ProjectController::class, 'recycle'])->name('project.recycle');

- public function recycle() {
        $trashed = Project::onlyTrashed()->orderByDesc('id')->paginate('10');
        
        return view('admin.projects.recycle', compact('trashed'));
        
    }

- dopo aver creata il layout nella page recycle aggiungere un btn con route('project.restore') per riportare in index i progetti cancellati temporaneamente

- creare un function restore nell ProjectController

- creare Route::get('project/{id}/restore',[ProjectController::class, 'restore'])->name('project.restore'); //se scrivo ->name('projects.restore') il percorso sarà admin.projects.restore

- creo in layouts/admin.blade.php un link alla pagina recycle

    <a class="nav-link text-white {{ Route::currentRouteName() == 'project.recycle'}}" href="{{route('project.recycle')}}">
        <i class="fa-solid fa-dumpster fa-lg fa-fw"></i> Trashed
    </a> 