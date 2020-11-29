<template>
    <div>
      <b-table
      :items="items"
      :fields="fields"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      responsive="sm"
    ></b-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
          sortBy: 'id',
        sortDesc: false,
        fields: [
          { key: 'id', label:'ID', sortable: true },
          { key: 'country.name.ar', label:'Country', sortable: true },
          { key: 'name.ar', label:'Name', sortable: true },
          { key: 'status', label:'Status',  sortable: false }
        ],
        items: []
        };
    },
    mounted() {
         const requestSend = {
                resource: "area",
            };
            this.$store.dispatch("areas/getData", requestSend).then(res => {
                this.items = res.data.data;
            });
    }
};
</script>

<style></style>
