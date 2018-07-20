<template>
  <div @click="onClick">
  <table class="table">
    <thead>
     <tr>
        <th> </th>
        <th></th>
        <th><label>Name : </label> <span>{{rowData.title}}</span></th>
        <th><label>Author : </label> <span>{{rowData.author}}</span></th>
        <th><label>QTY : </label> <span>{{rowData.qty}}</span></th>
      </tr>
    </thead>
    </table>
    </div>
</template>

<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    }
  },
  methods: {
    onClick (event) {
     // console.log('my-detail-row: on-click', event.target)
    }
  },
}
</script>