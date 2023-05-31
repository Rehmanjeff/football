import { createWebHistory, createRouter } from "vue-router";
import Home from "@/site/pages/Home.vue";
import AdminHome from "@/admin/pages/Home.vue";
import TeamList from "@/admin/pages/TeamList.vue";
import Addteam from "@/admin/pages/Addteams.vue"
import TransferPlayer from "@/admin/pages/TransferPlayer.vue"

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: { isUserRoute: true },
  },
  {
    path: "/admin",
    name: "AdminHome",
    component: AdminHome,
    meta: { isAdminRoute: true },
  },
  
  {
    path: "/admin/team/add",
    name: "Addteam",
    component: Addteam,
    meta: { isAdminRoute: true },
  },
  

  {
    path: "/admin/team/list",
    name: "TeamList",
    component: TeamList,
    meta: { isAdminRoute: true },
    props: (route) => ({ page: route.query.page })
  },

  {
    path: "/admin/team/:teamId/transfer/player/:playerId",
    name: "TransferPlayer",
    component: TransferPlayer,
    meta: { isAdminRoute: true },
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;