FROM node:20-alpine

RUN apk add --no-cache make gcc g++ python3 linux-headers udev

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

EXPOSE 3000

CMD ["node", "server.js"]