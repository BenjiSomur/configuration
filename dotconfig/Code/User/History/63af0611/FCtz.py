from decoder import decode
import sys
import os


def write_headers(kwargs):
    _filename = kwargs['filename']
    _pop_size = kwargs['pop_size']
    _cp = kwargs['cp']
    _mp = kwargs['mp']
    _it_no = kwargs['it_no']
    _im_type = kwargs['type']
    _theta = kwargs['theta']
    _intx = kwargs['intx']
    _header1 = f'Implementation: {_im_type}\nBenchmark:{_filename}\nIteration:{_it_no}\n'
    _header2 = 'Pop size: {}\nCrossover: {}\nMutation: {}\nTheta: {}\n'.format(_pop_size,
                                                                               _cp, _mp, _theta)
    _path = f'./{_filename}/{_im_type}/{_intx}'
    if not os.path.exists(_path):
        os.makedirs(_path)

    _ev_path = f"{_path}/{_it_no}"

    if not os.path.exists(_ev_path):
        os.makedirs(_ev_path)
    with open('{}/evol.txt'.format(_ev_path), 'w') as _output:
        _output.write(_header1)
        _output.write(_header2)
        _output.write('----------------------------------------------\n')
    with open('{}/gens.csv'.format(_ev_path), 'w') as _out:
        _out.write('No_gen, Best, MQ, No_clus, max_clus, min_clus\n')


def write_gen(kwargs):
    _filename = kwargs['filename']
    _it_no = kwargs['it_no']
    _best = kwargs['best']
    _no_gen = kwargs['gen']
    _fitness = kwargs['fitness']
    _im_type = kwargs['type']
    _intx = kwargs['intx']
    _path = f'./{_filename}/{_im_type}/{_intx}/{_it_no}/evol.txt'

    with open(_path, 'a') as _output:
        _output.write('No. Gen: {}\n'.format(_no_gen))
        _output.write('Best: {}\n'.format(_best))
        _output.write('Fitness: {}\n'.format(_fitness[0]))
        _output.write('MQ : {}\n'.format(_fitness[1]))
        _output.write('----------------------------------------------\n')


def write_csv(kwargs):
    _filename = kwargs['filename']
    _it_no = kwargs['it_no']
    _no_gen = kwargs['gen']
    _fitness = kwargs['fitness']
    _im_type = kwargs['type']
    _intx = kwargs['intx']
    _nodes = kwargs['nodes']
    _best = decode(kwargs['best'], _nodes)
    _no_clus = len(_best)
    _aux = sorted(_best, key=lambda x: len(x))
    _max_clus = len(_aux[-1])
    _min_clus = len(_aux[0])
    _path = f'./{_filename}/{_im_type}/{_intx}/{_it_no}/gens.csv'
    with open(_path, 'a') as _output:
        _output.write('{},{},{},{},{},{}\n'.format(_no_gen,
                                                   _fitness[0],
                                                   _fitness[1],
                                                   _no_clus,
                                                   _max_clus,
                                                   _min_clus))
