import axios from "axios"

const Player = () => {

    const playerDetails = async (data) => {

        try {

          const response = await axios.post("http://127.0.0.1:8000/player", data);
          return response;
        } catch (err) {

          return err;
        }
    };

    return {
        playerDetails
    }
};

export default Player;