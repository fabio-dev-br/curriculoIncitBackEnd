var cf = require("./CurrencyFormatter");

Vue.filter('moneyFormatter', function (value) {
    if (value == "")
        return '--,--';
    return cf.floatToCurrency(value);
});

Vue.filter('moneyFormatterWithZero', function (value) {
    return cf.floatToCurrency(value);
});
