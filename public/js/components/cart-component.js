let cartComponent = {
    delimiters: ['${', '}'],
    props: ['cart'],
    template: '<ol>' +
        '        <li' +
        '                v-for="item in cart"' +
        '                v-bind:item="item"' +
        '                v-bind:key="item.product_id"' +
        '        >${ item.title } - </li>' +
        '    </ol>'
};