<template>
  <div class="container mt-5">
    <Loader v-if="eventLoading" />

    <div v-else class="calendar text-center">
      <a class="btn btn-outline-primary" href="/home"
        >Gestisci i tuoi appuntamenti</a
      >
      <FullCalendar v-if="!eventLoading" :options="calendarOptions" />
    </div>
  </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import Loader from "./Loader.vue";

export default {
  components: {
    FullCalendar, // make the <FullCalendar> tag available
    Loader,
  },
  data() {
    return {
      organizers: [],
      eventLoading: false,
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        events: [],
      },
    };
  },

  methods: {
    getOrganizers() {
      this.eventLoading = true;
      /* take user id from head */
      const user_id = document
        .querySelector('meta[name="user-id"]')
        .getAttribute("content");
      axios
        .get(`http://localhost:8000/api/organizer?user_id=${user_id}`)
        .then((res) => {
          console.log(res.data);
          this.organizers = res.data;
        })
        .catch((err) => {
          console.error(err);
          console.log("Call error");
        })
        .then(() => {
          console.log("Call finished");
          /* call set events to fill calendar */
          this.setEvents();
        });
    },

    setEvents() {
      /* each organizer push to events */
      this.organizers.forEach((o) => {
        const obj = {
          title: o.description || "No description",
          date: o.expire,
        };
        this.calendarOptions.events.push(obj);
      });
      this.eventLoading = false;
    },
  },
  mounted() {
    this.getOrganizers();
  },
};
</script>
 <style lang="scss">
body {
  background-color: #f8fafc;
}
</style>