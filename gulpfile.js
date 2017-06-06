/**
 * Created by michaldrzewiecki on 21.04.2017.
 */
var elixir = require("laravel-elixir");

elixir(function(mix) {
    mix.sass("app.scss");
    mix.version("css/app.css");
});
