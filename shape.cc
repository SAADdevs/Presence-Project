#include "shape.h"

// Valeur epsilon pour la comparaison des angles
const double eps_zero = 1e-6;

// Calcule le produit scalaire entre deux vecteurs
double produitScalaire(const Segment& s1, const Segment& s2) {
    double dx1 = s1.end.x - s1.start.x;
    double dy1 = s1.end.y - s1.start.y;
    double dx2 = s2.end.x - s2.start.x;
    double dy2 = s2.end.y - s2.start.y;

    return dx1 * dx2 + dy1 * dy2;
}

// Calcule l'écart angulaire entre deux segments
double ecartAngulaire(const Segment& s1, const Segment& s2) {
    double dot = produitScalaire(s1, s2);
    double dx1 = s1.end.x - s1.start.x;
    double dy1 = s1.end.y - s1.start.y;
    double dx2 = s2.end.x - s2.start.x;
    double dy2 = s2.end.y - s2.start.y;

    double det = dx1 * dy2 - dy1 * dx2;
    return atan2(fabs(det), dot);
}

// Vérifie si deux segments sont superposés
void superposition(const Segment& s1, const Segment& s2) {
    double angle = ecartAngulaire(s1, s2);
    if (angle < eps_zero) {
        // Afficher un message d'erreur
        std::cout << "Erreur : Les segments sont superposés." << std::endl;
    }
}

// Fonction qui vérifie si un point r se trouve sur le segment p-q
// Fonction qui vérifie si un point r se trouve sur le segment p-q
bool onSegment(const S2d& p, const S2d& q, const S2d& r) {
    double norm_pq = sqrt(pow(q.x - p.x, 2) + pow(q.y - p.y, 2));
    double dx = (r.x - p.x) / norm_pq;
    double dy = (r.y - p.y) / norm_pq;

    double dot_product = dx * (q.x - p.x) + dy * (q.y - p.y);
    double cross_product = dx * (q.y - p.y) - dy * (q.x - p.x);

    if (fabs(cross_product) > eps_zero) {
        return false;
    }

    if (dot_product < -eps_zero || dot_product > norm_pq + eps_zero) {
        return false;
    }

    return true;
}



// Fonction qui calcule l'orientation de trois points (p, q, r)
int orientation(const S2d& p, const S2d& q, const S2d& r) {
    double norm_pq = sqrt(pow(q.x - p.x, 2) + pow(q.y - p.y, 2));
    double val = ((q.y - p.y) * (r.x - q.x) - (q.x - p.x) * (r.y - q.y)) / norm_pq;

    if (fabs(val) < eps_zero) return 0; // collinear

    return (val > 0) ? 1 : 2; // clock or counterclock wise
}


// Fonction qui vérifie si deux segments se croisent
bool doIntersect(const S2d& p1, const S2d& q1, const S2d& p2, const S2d& q2) {
    // Find the four orientations needed for general and
    // special cases
    int o1 = orientation(p1, q1, p2);
    int o2 = orientation(p1, q1, q2);
    int o3 = orientation(p2, q2, p1);
    int o4 = orientation(p2, q2, q1);

    // General case
    if (o1 != o2 && o3 != o4)
        return true;

    // Special Cases
    // p1, q1 and p2 are collinear and p2 lies on segment p1q1
    if (o1 == 0 && onSegment(p1, p2, q1)) return true;

    // p1, q1 and q2 are collinear and q2 lies on segment p1q1
    if (o2 == 0 && onSegment(p1, q2, q1)) return true;

    // p2, q2 and p1 are collinear and p1 lies on segment p2q2
    if (o3 == 0 && onSegment(p2, p1, q2)) return true;

    // p2, q2 and q1 are collinear and q1 lies on segment p2q2
    if (o4 == 0 && onSegment(p2, q1, q2)) return true;

    return false; // Doesn't fall in any of the above cases
}
int main() {
    return 0;
}
