import axios from "axios"

const Team = () => {

    const createTeam = async (data) => {

        try {

          const response = await axios.post("http://127.0.0.1:8000/teams", data);
          return response;
        } catch (err) {

          return err;
        }
    };

    const paginatedTeams = async (page = '') => {

        try {

          const response = page == '' ? await axios.get("http://127.0.0.1:8000/teams") : await axios.get("http://127.0.0.1:8000/teams"+"?page="+page);
          return response;
        } catch (err) {

          return err;
        }
    };

    const allTeams = async () => {

        try {

          const response = await axios.get("http://127.0.0.1:8000/teams/all");
          return response;
        } catch (err) {

          return err;
        }
    };

    const transferTeamPlayer = async (data) => {

        try {

          const response = await axios.post("http://127.0.0.1:8000/teams/transfer-player", data);
          return response;
        } catch (err) {

          return err;
        }
    };

    return {
        createTeam,
        allTeams,
        transferTeamPlayer,
        paginatedTeams
    }
};

export default Team;