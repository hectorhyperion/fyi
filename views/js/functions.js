
function getCookie(name) {
  const cookies = document.cookie.split("; ");
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].split("=");
    if (cookie[0] === "jwt_token") {
      return cookie[1];
    }
  }
  return null;
  }
  