import axios from "axios"

const Country = () => {

    const allCountries = async () => {

        try {

            let response = await axios.get('http://127.0.0.1:8000/countries');
            return response;
        }catch(err){

            return err;
        }
    };

    return {
        allCountries
    }
};

export default Country;