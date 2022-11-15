<script>
export function getRoute (a, b, c) {
    let ret = a;
    if (typeof b !== "undefined") {
        ret += '.' + b;
    }
    if (typeof c !== "undefined") {
        ret += '.' + c;
    }
    return ret;
}

export function getSlashedRoute (a, b, c) {
    let ret = '/' + a;
    if (typeof b !== "undefined") {
        ret += '/' + b;
    }
    if (typeof c !== "undefined") {
        ret += '/' + c;
    }
    return ret;
}
</script>
