 <template>
    <div class="custom-banner-images">
 <img :src="'../public/img/'+rowData.image" class="imgnya img-responsive">
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
    }
    }
  </script>

  <style>
.imgnya{
        max-height: 150px;
        max-width: 150px;
    }
  </style>