/**
 * Created by nomantufail on 26/11/2016.
 */

app.filter('priceToText', function() {
    return function(item, props) {
        return digitsToWords(item);
    };
});