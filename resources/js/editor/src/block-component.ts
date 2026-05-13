import Block from './block';



export default class BlockComponent {
  id: string;
  name: string
  type: string;
  description: string;
  thumbnail: string;  
  blocks: Block[];

  constructor(
    id: string,
    name: string,
    type: string,
    description: string,
    thumbnail: string,    
    blocks: Block[]
  ) {
    this.id = id;
    this.name = name;
    this.type = type;
    this.description = description;
    this.thumbnail = thumbnail;    
    this.blocks = blocks;
  }

}