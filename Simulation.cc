#include "Lifeform.h"
#include "shape.h"
#include "message.h"
#include "constantes.h"
#include <iostream>
#include "Simulation.h"


void Simulation::readFromFile(const std::string& filename) {
    std::ifstream file(filename);

    if (!file) {
        throw std::runtime_error("Could not open file");
    }
    else {
        file >> nbr_alg;
        Arg* T_Arg = new Arg[nbr_alg];
        Coral* T_coreil = Coral[]
            for (int i = 0; i < nbr_alg; ++i) {
                double x, y, age;
                file >> x >> y >> age;
                T_Arg[i] = Arg(x, y, age);
            }
        file >> nbr_cor;
        T_cor = new Coral[nbr_cor];
        for (int i = 0; i < nbr_cor; ++i) {
            double x, y, age, id;
            Status_cor status;
            Dir_rot_cor direction;
            Status_dev  development;
            int nbr_seg;
            file >> x >> y >> age1 >> id << status << direction << development >> nbr_seg;
            double tab_l[nbr_seg];
            double tab_angl[nbr_seg];
            for (int i = 0; i < nbr_seg; i++)
            {
                file << tab_angl[i];
                file << tab_l[i];
            }
            T_cor[i] = Coral(x, y, age, id, status, direction, devlopment, nbr_seg, tab_l, tab_angl);
        }
        f >> nbr_scavanger;
        sca = new Scavenger[nbr_scavanger];
        double x, double y, int ag, double radiu, Status_sca status_, int id_)
        for (int i = 0; i < nbr_scavanger; ++i) {
            f >> x >> y >> ag >> radiu >> status_ >> id_;
            Scavanger b(x, y, ag, radiu, status_, id_);
            sca[i] = b;
        }

    }
    file.close();
}
void Simulation::Test(Alg* alg, Corail* cor, Scavenger* sca) {

    for (int i = 0; i < nbr_alg; ++i) {
        alg[i].testAge();
        alg[i].testPosition();
    }

    for (int i = 0; i < nbr_cr; ++i) {

        cor[i].testAge();
        cor[i].testPosition();
        cor[i].testAlpha();
        cor[i].testLength();
        cor[i].testDuplicatedId();
    }

    for (int i = 0; i < nbr_scav; ++i) {

        sca[i].testAge();
        sca[i].testPosition();
        sca[i].testRayon();
        sca[i].testInvalidId();
    }

    for (int i = 0; i < nbr_cr; ++i) {
        Segment* s = cor[i].get_seg();
        for (int j = 0; j < cor[i].getnb_seg() - 1; ++j) {
            segment_cons(cor[i].getid(), s[j], s[j + 1]);
        }
        for (int j = 0; j < cor[i].getNbrSegment(); ++j) {
            for (int k = 0; k < nbr_cr; ++k) {
                Segment* se = cor[k].getNbrSegment();
                for (int n = 0; n < cor[k].getNbrSegment(); ++n) {
                    if (cor[k].getId() != cor[i].getId() || s[j].index != se[n].index) {
                        intersection(cor[i].getId(), cor[k].getId(), s[j], se[n]);
                    }
                }
            }
        }
    }
}

