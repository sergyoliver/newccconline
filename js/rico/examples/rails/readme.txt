
This is a copied version of the software running on the openrico site.  It currently uses rails 1.1.6.  However, the plugin is portable across versions.

Weather demo
WEATHER_KEY constant is specified in the config/envionrment.rb. It is blank in this copy.  In order to run this demo, you must get a key from weather.com and assign it to WEATHER_KEY.

LiveGrid
This is the only demo that requires a database.
The database.yml expects a databased called 'rico'.  The sql for this database example is in db/rico_livegrid.sql