String.prototype.format = function () {
    var result = this.toString();
    var arg = arguments.length == 1 && typeof arguments[0] == 'object' ? arguments[0] : arguments;

    for (var value in arg) {
        //result = result.replace('{' + value + '}', arg[value]);
        result = result.split('{' + value + '}').join(arg[value]);
    }

    return result;
}